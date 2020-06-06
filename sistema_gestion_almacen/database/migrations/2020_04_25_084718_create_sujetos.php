<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSujetos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->string('poblacion');
            $table->string('codigoPostal');
            $table->string('provincia');
            $table->string('pais'); 
            $table->timestamps();
    
        });



        Schema::create('sujetos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('primerApellido')->nullable();
            $table->string('segundoApellido')->nullable();
            $table->string('nif');
            $table->string('email');
            $table->string('telefono')->nullable();
            $table->string('personaContacto')->nullable();
            $table->string('paginaWeb')->nullable();
            $table->unsignedBigInteger('direccion_id')->unique();
            $table->timestamps(); 
 
            $table->foreign('direccion_id')->references('id')->on('direcciones');     
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sujetos');
        Schema::dropIfExists('direcciones');
    }
}
