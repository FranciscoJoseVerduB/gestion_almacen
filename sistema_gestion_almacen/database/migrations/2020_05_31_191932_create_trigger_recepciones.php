<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerRecepciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tringger before delete
        DB::unprepared("
         CREATE  TRIGGER `recepciones_BEFORE_DELETE` BEFORE DELETE ON `recepciones` FOR EACH ROW
            BEGIN
                DELETE FROM recepcionlineas where recepcion_id = OLD.id;
                
                    -- Grabamos log del trigger         
                    insert into log_triggers (tabla, id_tabla, operacion, mensaje)
                        values ('recepciones',  OLD.`id`, 'before_delete', 'Se ha eliminado la cabecera de la recepcion');
                    
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
        DB::unprepared("DROP TRIGGER  IF EXISTS `recepciones_BEFORE_DELETE`");
    }
}
