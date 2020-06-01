<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecepciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('recepciones', function (Blueprint $table) {
            $table->id();
            $table->string('serie');
            $table->unsignedInteger('numero');
            $table->text('observaciones')->nullable();
            $table->date('fecha');
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('usuario_id')->nullable(); 
            $table->timestamps();
            
            $table->unique(['serie', 'numero']);
                        
            $table->foreign('proveedor_id')->references('id')->on('proveedores'); 
            $table->foreign('almacen_id')->references('id')->on('almacenes');   
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');
        });
 

        Schema::create('recepcionLineas', function (Blueprint $table) {
            $table->id();
            $table->double('cantidad'); 
            $table->unsignedBigInteger('producto_id'); 
            $table->unsignedBigInteger('recepcion_id');  
            $table->timestamps();
            $table->foreign('producto_id')->references('id')->on('productos');  
            $table->foreign('recepcion_id')->references('id')->on('recepciones')->onDelete('cascade');    
        });


 

        Schema::create('pedidoCompraLinea_RecepcionLinea', function (Blueprint $table) {   
            $table->unsignedBigInteger('pedidoCompraLinea_id');
            $table->unsignedBigInteger('recepcionLinea_id');
            $table->primary('pedidoCompraLinea_id', 'recepcionLinea_id')->unique();
            $table->timestamps();
            
            $table->foreign('pedidoCompraLinea_id')->references('id')->on('pedidoCompraLineas')->onDelete('cascade');  
            $table->foreign('recepcionLinea_id')->references('id')->on('recepcionLineas')->onDelete('cascade'); 
        });


        








    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidoCompraLinea_RecepcionLinea');
        Schema::dropIfExists('recepcionLineas'); 
        Schema::dropIfExists('recepciones');
    }
}
