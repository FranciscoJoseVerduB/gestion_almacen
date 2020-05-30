<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->double('cantidad');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('almacen_id');
            $table->string('url');
            $table->timestamps();
            $table->unique('producto_id', 'almacen_id');
                         
            $table->foreign('producto_id')->references('id')->on('productos');     
            $table->foreign('almacen_id')->references('id')->on('almacenes');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
