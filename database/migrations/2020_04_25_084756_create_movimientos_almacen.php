<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosAlmacen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::create('clavesMovimientos', function (Blueprint $table) {
            $table->id(); 
            $table->string('codigo')->unique();
            $table->boolean('esEntrada');  
            $table->timestamps(); 
        });

        Schema::create('tiposMovimientosAlmacenes', function (Blueprint $table) {
            $table->id(); 
            $table->string('codigo')->unique();
            $table->string('nombre'); 
            $table->unsignedBigInteger('claveMovimiento_id'); 
            $table->timestamps();

            $table->foreign('claveMovimiento_id')->references('id')->on('clavesMovimientos'); 
        });

        Schema::create('movimientosAlmacenes', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('tipoMovimientoAlmacen_id'); 
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('documentoOrigen_id');
            $table->string('documentoOrigen_type');
            $table->timestamps();
            
            $table->foreign('tipoMovimientoAlmacen_id')->references('id')->on('tiposMovimientosAlmacenes');  
            $table->foreign('almacen_id')->references('id')->on('almacenes'); 
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
        Schema::dropIfExists('movimientosAlmacenes');
        Schema::dropIfExists('tiposMovimientosAlmacenes');
        Schema::dropIfExists('clavesMovimientos');


        
    }
}

