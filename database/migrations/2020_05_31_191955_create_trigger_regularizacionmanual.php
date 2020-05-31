<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerRegularizacionmanual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Trigger before delete
        DB::unprepared("
            CREATE   TRIGGER  `regularizacionesmanuales_BEFORE_DELETE` BEFORE DELETE ON `regularizacionesmanuales` FOR EACH ROW
            BEGIN
                DELETE FROM regularizacionManualLineas where regularizacionManual_id = OLD.id;
                
                    -- Grabamos log del trigger         
                    insert into log_triggers (tabla, id_tabla, operacion, mensaje)
                        values ('regularizacionesManuales',  OLD.`id`, 'before_delete', 'Se ha eliminado la cabecera del documento de regularizacion');
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
        DB::unprepared("DROP TRIGGER IF EXISTS `regularizacionesmanuales_BEFORE_DELETE`");
    }
}
