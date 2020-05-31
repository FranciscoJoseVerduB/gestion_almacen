<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerRecepcionlineas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Trigger after update
        DB::unprepared("
            CREATE  TRIGGER `recepcionlineas_AFTER_UPDATE` AFTER UPDATE ON `recepcionlineas` FOR EACH ROW
            BEGIN
                call MovimientosAlmacen_ActualizarStock(0,0);
            END
        ");

        //Trigger before delete
        DB::unprepared("
 
            CREATE   TRIGGER `recepcionlineas_BEFORE_DELETE` BEFORE DELETE ON `recepcionlineas` FOR EACH ROW
            BEGIN
                DELETE FROM pedidocompralinea_recepcionlinea where recepcionLinea_id = OLD.id;
                DELETE FROM movimientosAlmacenes
                    WHERE documentoOrigen_type like 'App_RecepcionLinea'
                    AND documentoOrigen_id = OLD.id;
                
                    -- Grabamos log del trigger         
                    insert into log_triggers (tabla, id_tabla, operacion, mensaje)
                        values ('recepcionlineas',  OLD.`id`, 'before_delete', 'Se ha eliminado la linea de la recepcion');
                    
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
        DB::unprepared("DROP TRIGGER IF EXISTS `recepcionlineas_AFTER_UPDATE`");
        DB::unprepared("DROP TRIGGER IF EXISTS`recepcionlineas_BEFORE_DELETE`");
    }
}
