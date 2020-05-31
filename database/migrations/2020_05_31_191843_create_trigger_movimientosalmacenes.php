<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerMovimientosalmacenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Procedimiento para calcular y actualizar el stock por producto y almacen
        DB::unprepared("
        
        DROP PROCEDURE IF EXISTS `MovimientosAlmacen_ActualizarStock`;
        
        CREATE  PROCEDURE `MovimientosAlmacen_ActualizarStock`(
            IN _almacen_id INT,
            IN _producto_id INT
        )
        BEGIN
          
          /* Limpiamos la tabla Stock */
            DELETE FROM Stocks;
            
            INSERT INTO Stocks(cantidad, producto_id, almacen_id, url, created_at, updated_at)
                 (select  sum(case cm.EsEntrada
                                            WHEN 1 then COALESCE(rl.Cantidad, rml.cantidad, pcl.cantidad, 0)
                                            WHEN 0 then COALESCE(rl.Cantidad, rml.cantidad, pcl.cantidad, 0)  * -1
                                        END) 		Cantidad, 
                                ma.producto_id,
                                ma.almacen_id,
                                CONCAT(cast(ma.almacen_id as char) , '-' , Cast(ma.producto_id as char)) URL,
                                current_timestamp(),
                                current_timestamp()
                                    
                                from movimientosalmacenes ma
                                    inner join tiposmovimientosalmacenes tma on tma.id = ma.tipoMovimientoAlmacen_id
                                    inner join clavesMovimientos cm on cm.id = tma.claveMovimiento_id
                                    left join recepcionLineas rl on   ma.documentoOrigen_type like 'App_RecepcionLinea'  
                                                                    and ma.documentoOrigen_id = rl.id
                                    left join pedidocompralineas pcl on   ma.documentoOrigen_type like 'App_PedidoCompraLinea'  
                                                                    and ma.documentoOrigen_id = pcl.id
                                    left join regularizacionmanuallineas rml on   ma.documentoOrigen_type like 'App_RegularizacionManualLinea'  
                                                                    and ma.documentoOrigen_id = rml.id
                                where (rl.id IS NOT NULL OR
                                        pcl.id IS NOT NULL OR
                                            rml.id IS NOT NULL)
                            GROUP BY 
                                    CONCAT(cast(ma.almacen_id as char) , '-' , Cast(ma.producto_id as char)),
                                    ma.producto_id,
                                    ma.almacen_id); 
         END
        
        ");

        //Trigger after delete
        DB::unprepared("
            CREATE   TRIGGER  `movimientosalmacenes_AFTER_DELETE` AFTER DELETE ON `movimientosalmacenes` FOR EACH ROW
            BEGIN
                call MovimientosAlmacen_ActualizarStock(OLD.almacen_id, OLD.producto_id);
            END
        ");

        //Trigger after insert
        DB::unprepared("
            CREATE  TRIGGER  `movimientosalmacenes_AFTER_INSERT` AFTER INSERT ON `movimientosalmacenes` FOR EACH ROW
            BEGIN
                call MovimientosAlmacen_ActualizarStock(NEW.almacen_id, NEW.producto_id);
            END
        ");

        //Trigger after update
        DB::unprepared("
            CREATE DEFINER=`root`@`localhost` TRIGGER  `movimientosalmacenes_AFTER_UPDATE` AFTER UPDATE ON `movimientosalmacenes` FOR EACH ROW
            BEGIN
                call MovimientosAlmacen_ActualizarStock(NEW.almacen_id, NEW.producto_id);
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
        DB::unprepared("DROP PROCEDURE IF EXISTS `MovimientosAlmacen_ActualizarStock` ");
        DB::unprepared("DROP TRIGGER IF EXISTS `movimientosalmacenes_AFTER_DELETE`");
        DB::unprepared("DROP TRIGGER IF EXISTS `movimientosalmacenes_AFTER_INSERT`");
        DB::unprepared("DROP TRIGGER  IF EXISTS `movimientosalmacenes_AFTER_UPDATE`");
    }
}
