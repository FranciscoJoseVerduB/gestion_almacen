<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmacenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('geolocalizaciones', function (Blueprint $table) {
            $table->id();
            $table->string('latitud');
            $table->string('longitud');
            $table->timestamps();
        });

        
        Schema::create('almacenes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->unsignedBigInteger('sujeto_id')->unique();
            $table->unsignedBigInteger('geolocalizacion_id')->unique();
            $table->timestamps(); 
            
            $table->foreign('sujeto_id')->references('id')->on('sujetos');      
            $table->foreign('geolocalizacion_id')->references('id')->on('geolocalizaciones'); 
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('almacenes');
        Schema::dropIfExists('geolocalizaciones');
    }
}
