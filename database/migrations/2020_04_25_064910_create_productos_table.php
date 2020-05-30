<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familias', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre'); 
            $table->timestamps();
        });

        Schema::create('subfamilias', function (Blueprint $table) {
            $table->id(); 
            $table->string('codigo')->unique();
            $table->string('nombre'); 
            $table->unsignedBigInteger('familia_id'); 
            $table->timestamps();

            $table->foreign('familia_id')->references('id')->on('familias'); 
        });

        Schema::create('impuestos', function (Blueprint $table) {
            $table->id(); 
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->float('porcentaje'); 
            $table->timestamps();
        });

        Schema::create('marcas', function (Blueprint $table) {
            $table->id(); 
            $table->string('codigo')->unique();
            $table->string('nombre'); 
            $table->timestamps();
        });


        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre'); 
            $table->float('precio'); 
            $table->unsignedBigInteger('subfamilia_id')->nullable();
            $table->unsignedBigInteger('marca_id')->nullable();
            $table->unsignedBigInteger('impuesto_id'); 
            $table->timestamps();

            $table->foreign('subfamilia_id')->references('id')->on('subfamilias');  
            $table->foreign('marca_id')->references('id')->on('marcas');  
            $table->foreign('impuesto_id')->references('id')->on('impuestos'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
        Schema::dropIfExists('marcas');
        Schema::dropIfExists('impuestos');
        Schema::dropIfExists('subfamilias');
        Schema::dropIfExists('familias'); 

    }
}
