<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoCompra extends Model
{
    protected $table = 'pedidoscompras';
    protected $guarded = ['id', 'created_at', 'updated_at'];
 


    public function getRouteKeyName(){
        return 'id';
    }

    

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
    

    public function almacen(){
        return $this->belongsTo(Almacen::class, 'almacenDestinoCompra_id');
    }


    public function estado(){
        return $this->belongsTo(PedidoCompraEstado::class, 'estadoPedido_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
    
    public function lineas(){
        return $this->hasMany(PedidoCompraLinea::class, 'pedidoCompra_id');     
    }
 


}
