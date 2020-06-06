<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegularizacionesManuales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regularizacionesManuales', function (Blueprint $table) {
            $table->id();
            $table->string('serie');
            $table->unsignedInteger('numero');
            $table->text('observaciones')->nullable();
            $table->date('fecha');
            $table->unsignedBigInteger('almacen_id'); 
            $table->unsignedBigInteger('usuario_id')->nullable(); 
            $table->timestamps();

            $table->unique(['serie', 'numero']);

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');  
            $table->foreign('almacen_id')->references('id')->on('almacenes'); 
        });


        Schema::create('regularizacionManualLineas', function (Blueprint $table) {
            $table->id();
            $table->double('cantidad');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('regularizacionManual_id'); 
            $table->timestamps();

            $table->foreign('regularizacionManual_id')->references('id')->on('regularizacionesManuales')->onDelete('cascade');           
            $table->foreign('producto_id')->references('id')->on('productos'); 
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regularizacionManualLineas');
        Schema::dropIfExists('regularizacionesManuales');
     }
}
