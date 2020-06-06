<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerPedidocompralineas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tringger After Delete

       DB::unprepared("
                    
            CREATE TRIGGER `pedidocompralineas_AFTER DELETE` AFTER DELETE ON `pedidocompralineas`
            FOR EACH ROW
            BEGIN
             
                IF (select count(*)
                        from pedidocompralineas pcl
                            inner join pedidocompralineaestados pcle on pcle.id = pcl.lineaPedidoEstado_id 
                        where pcl.pedidoCompra_id =  OLD.`id`
                            and pcle.estado in ('Servido', 'Parcialmente Servido')
                            and not exists( 
                                    select pcl2.id
                                        from pedidocompralineas pcl2
                                            inner join pedidocompralineaestados pcle2 on pcle2.id = pcl2.lineaPedidoEstado_id
                                        where pcl2.pedidoCompra_id =  OLD.`id`
                                            and pcle2.estado in ('Pendiente')
                            ) > 0 )
                        THEN  
                                update pedidoscompras    
                                    set estadoPedido_id = (select  min(id) from pedidocompraestados where estado= 'Servido')
                                where id = @idPedidoCabecera; 
                        ELSE 
                                update pedidoscompras    
                                    set estadoPedido_id = (select  min(id) from pedidocompraestados where estado= 'Pendiente')
                                where id = @idPedidoCabecera; 
                END IF;
                
                -- Grabamos log del trigger         
                insert into log_triggers (tabla, id_tabla, operacion, mensaje)
                    values ('pedidocompralineas',  OLD.`id`, 'after_delete_update', 'Se ha actualizado la linea del pedido de compra');              
            END      
       ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER IF EXISTS `pedidocompralineas_AFTER DELETE`"); 
    }
}
