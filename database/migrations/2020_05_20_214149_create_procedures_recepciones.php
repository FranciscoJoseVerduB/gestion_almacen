<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProceduresRecepciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
 /*
        // Procedimiento y trigger para insertar un registro en la tabla
        $procedure = ` 
    
        DELIMITER //
        CREATE PROCEDURE pedidocompralinea_recepcionlinea_CambiarEstados
        (
            IN idLineaRecepcion INT
        ) 
        begin
        
        -- Obtenemos el total que ha puesto el usuario en la linea de recepción en la linea del pedido que vincula
        -- Es decir, al vincular la linea del pedido con la recepción, quiere decir que 
        SET @cantidadRecibida = COALESCE((select sum(rl.cantidad)
                    from recepcionlineas rl 
                        inner join pedidocompralinea_recepcionlinea pcl_rl on rl.id = pcl_rl.recepcionLinea_id
                        inner join pedidocompralineas pcl  on pcl_rl.pedidoCompraLinea_id = pcl.id  
                    WHERE pcl_rl.recepcionLinea_id = idLineaRecepcion), 0);
                    
        
        -- Obtenemos el id de la linea del pedido
        SET @idLineaPedido = (select pcl.id 
                                    from pedidocompralineas pcl 
                                    inner join pedidocompralinea_recepcionlinea pcl_rl on pcl_rl.pedidoCompraLinea_id = pcl.ID
                                                                    and  pcl_rl.recepcionLinea_id = idLineaRecepcion );
        
        
        update pedidocompralineas pcl  
                set cantidadRecibida =  @cantidadRecibida
            where  id = @idLineaPedido;
            
        -- Revisamos si la cantidad recibida es igual o superior a la cantidad que se pidio
        -- De ser asi, actualizamos el estado de la linea a servido
        -- En caso de tener algo servido pero no estarlo completamente, se actualizará a parcialmente servido
        
        IF @cantidadRecibida >= (select sum(cantidad) from pedidocompralineas where id = @idLineaPedido) THEN  
            update pedidocompralineas    
                    set lineaPedidoEstado_id = (select  min(id) from pedidocompralineaestados where estado= 'Servido')
                where id = @idLineaPedido;
        -- SI la cantidad recibida es superior a 0 pero no es superior a la cantidad pedida, se establecera como parcialmente servido
        ELSEIF @cantidadRecibida < (select sum(cantidad) from pedidocompralineas where id = @idLineaPedido) 
                    AND @cantidadRecibida > 0
                        THEN  
                    update pedidocompralineas   
                            set lineaPedidoEstado_id = (select  min(id) from pedidocompralineaestados where estado= 'ParcialmenteServido')
                        where id = @idLineaPedido;
        
        
        END IF;
        -- Si la cabecera de la linea del pedido contiene todas las lineas parcialmente servidas o servidas, se actualizará a servido
        -- En caso de que alguna de las lineas esté en estado 'Pendiente' no se actualizará a servido 
        -- Obtenemos el id de la linea del pedido
        SET @idPedidoCabecera = (select  DISTINCT pcl.pedidoCompra_id 
                                    from pedidocompralineas pcl 
                                    inner join pedidocompralinea_recepcionlinea pcl_rl on pcl_rl.pedidoCompraLinea_id = pcl.ID
                                                                    and  pcl_rl.recepcionLinea_id = idLineaRecepcion );
                
                IF (select count(*)
                        from pedidocompralineas pcl
                            inner join pedidocompralineaestados pcle on pcle.id = pcl.lineaPedidoEstado_id 
                        where pcl.pedidoCompra_id = @idPedidoCabecera
                            and pcle.estado in ('Servido', 'Parcialmente Servido')
                            and not exists( 
                                    select pcl2.id
                                        from pedidocompralineas pcl2
                                            inner join pedidocompralineaestados pcle2 on pcle2.id = pcl2.lineaPedidoEstado_id
                                        where pcl2.pedidoCompra_id = @idPedidoCabecera
                                            and pcle2.estado in ('Pendiente')
                            ) > 0 )
                        THEN  
                                update pedidoscompras    
                                    set estadoPedido_id = (select  min(id) from pedidocompraestados where estado= 'Servido')
                                where id = @idPedidoCabecera; 
                END IF;
        
        
           
        END // 
        
        
        
        `;

        DB::unprepared($procedure);


        $trigger = 'DELIMITER $$
            -- DROP TRIGGER IF EXISTS `pedidocompralinea_recepcionlinea_insert` ;  
            CREATE TRIGGER `pedidocompralinea_recepcionlinea_insert` AFTER INSERT ON `pedidocompralinea_recepcionlinea`
                FOR EACH ROW
                BEGIN
                CALL pedidocompralinea_recepcionlinea_CambiarEstados(NEW.`recepcionLinea_id`);
                END;
                $$';
                
            DB::unprepared($trigger);
        


            //Procedimiento y trigger para restablecer los estados y cantidades recibidas de los pedidos
            $procedure = "    
        
        
                    DELIMITER //
                    CREATE PROCEDURE pedidocompralinea_recepcionlinea_ReestablecerEstados
                    (
                        IN idLineaRecepcion INT
                    ) 
                    begin
                    
                    -- Obtenemos el id de la linea del pedido
                    SET @idLineaPedido = (select pcl.id 
                                                from pedidocompralineas pcl 
                                                inner join pedidocompralinea_recepcionlinea pcl_rl on pcl_rl.pedidoCompraLinea_id = pcl.ID
                                                                                and  pcl_rl.recepcionLinea_id = idLineaRecepcion );
                    
                    -- Reestablecemos la cantidad recibida a 0 y actualizamos el estado a pendiente de servir
                    update pedidocompralineas pcl  
                            set lineaPedidoEstado_id = (select  min(id) from pedidocompralineaestados where estado= 'Pendiente'),
                                cantidadRecibida =  0
                        where  id = @idLineaPedido;
                    
                    
                    END //  
                " ;
        DB::unprepared($procedure);
    
        $trigger = "  

                    DELIMITER $$
                    DROP TRIGGER IF EXISTS `pedidocompralinea_recepcionlinea_delete` ;  
                    CREATE TRIGGER `pedidocompralinea_recepcionlinea_delete` BEFORE DELETE ON `pedidocompralinea_recepcionlinea`
                        FOR EACH ROW
                        BEGIN
                        
                                    
                            -- Obtenemos el id de la linea del pedido
                            SET @idLineaPedido = (select pcl.id 
                                                        from pedidocompralineas pcl 
                                                        inner join pedidocompralinea_recepcionlinea pcl_rl on pcl_rl.pedidoCompraLinea_id = pcl.ID
                                                                                        and  pcl_rl.recepcionLinea_id = OLD.`recepcionLinea_id`);
                    
                            -- Reestablecemos la cantidad recibida a 0 y actualizamos el estado a pendiente de servir
                            update pedidocompralineas pcl  
                                    set lineaPedidoEstado_id = (select  min(id) from pedidocompralineaestados where estado= 'Pendiente'),
                                        cantidadRecibida =  0
                                where  id = @idLineaPedido;
                        END;
                        $$";


        DB::unprepared($trigger);
    

*/



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { 
        /*
        DB::unprepared("DROP procedure IF EXISTS pedidocompralinea_recepcionlinea_CambiarEstados");
        DB::unprepared("DROP TRIGGER IF EXISTS `pedidocompralinea_recepcionlinea_insert`");

        DB::unprepared("DROP procedure IF EXISTS pedidocompralinea_recepcionlinea_ReestablecerEstados");
        DB::unprepared("DROP TRIGGER IF EXISTS `pedidocompralinea_recepcionlinea_delete`");
        */
    }
}
