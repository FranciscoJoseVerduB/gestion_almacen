<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerRegularizacionmanuallineas extends Migration
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
       CREATE   TRIGGER  `regularizacionmanuallineas_AFTER_UPDATE` AFTER UPDATE ON `regularizacionmanuallineas` FOR EACH ROW
            BEGIN
                CALL MovimientosAlmacen_ActualizarStock(0,0);
            END
       ");

        //Trigger before delete
        DB::unprepared("             
            CREATE   TRIGGER  `regularizacionmanuallineas_BEFORE_DELETE` BEFORE DELETE ON `regularizacionmanuallineas` FOR EACH ROW
            BEGIN 
                DELETE FROM movimientosAlmacenes
                    WHERE documentoOrigen_type like  'App_RegularizacionManualLinea'
                    AND documentoOrigen_id = OLD.id;
                
                
                /* Grabamos log del trigger */         
                    insert into log_triggers (tabla, id_tabla, operacion, mensaje)
                        values ('regularizacionmanuallineas',  OLD.`id`, 'before_delete', 'Se ha eliminado la linea del documento de regularizacion'); 
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
        DB::unprepared("DROP TRIGGER IF EXISTS `regularizacionmanuallineas_AFTER_UPDATE`");
        DB::unprepared("DROP TRIGGER IF EXISTS `regularizacionmanuallineas_BEFORE_DELETE`");
    }
}
