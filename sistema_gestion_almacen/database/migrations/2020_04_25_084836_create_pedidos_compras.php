<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosCompras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidoCompraLineaEstados', function (Blueprint $table) {
            $table->id();
            $table->string('estado')->unique();
            $table->timestamps();
        });
 

        Schema::create('pedidoCompraEstados', function (Blueprint $table) {
            $table->id(); 
            $table->string('estado')->unique();
            $table->timestamps();
        });
 

        Schema::create('pedidosCompras', function (Blueprint $table) {
            $table->id();
            $table->string('serie');
            $table->unsignedInteger('numero');
            $table->text('observaciones')->nullable();
            $table->date('fecha');
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('almacenDestinoCompra_id');
            $table->unsignedBigInteger('estadoPedido_id');
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->timestamps(); 

            $table->unique(['serie', 'numero']);
 
            $table->foreign('proveedor_id')->references('id')->on('proveedores');  
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null'); 
            $table->foreign('estadoPedido_id')->references('id')->on('pedidoCompraEstados');
            $table->foreign('almacenDestinoCompra_id')->references('id')->on('almacenes'); 
        });


        Schema::create('pedidoCompraLineas', function (Blueprint $table) {
            $table->id(); 
            $table->double('cantidad');
            $table->float('precio');
            $table->double('importe');
            $table->double('cantidadRecibida')->default(0);
            $table->unsignedBigInteger('pedidoCompra_id'); 
            $table->unsignedBigInteger('lineaPedidoEstado_id'); 
            $table->unsignedBigInteger('producto_id'); 
            $table->timestamps();

            $table->foreign('pedidoCompra_id')->references('id')->on('pedidosCompras')->onDelete('cascade');    
            $table->foreign('lineaPedidoEstado_id')->references('id')->on('pedidoCompraLineaEstados');             
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
        Schema::dropIfExists('pedidoCompraLineas'); 
        Schema::dropIfExists('pedidosCompras');  
        Schema::dropIfExists('pedidoCompraEstados');  
        Schema::dropIfExists('pedidoCompraLineaEstados');
        
    }
}
