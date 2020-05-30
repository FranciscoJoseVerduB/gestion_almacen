<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoCompraLinea extends Model
{ 
    protected $guarded = ['id',   'created_at', 'updated_at']; 
    protected $table = 'pedidocompralineas';
 
    
    public function pedido(){
        return $this->hasOne(PedidoCompra::class, 'id', 'pedidoCompra_id');     
    }
    
    public function estado(){
        return $this->belongsTo(PedidoCompraLineaEstado::class, 'lineaPedidoEstado_id');     
    }
    
    public function producto(){
        return $this->belongsTo(Producto::class);     
    }
    
    public function recepcionLineaPivot(){
        return $this->hasMany(PedidoCompraLinea_RecepcionLinea::class, 'pedidoCompraLinea_id');
    }

    public function movimiento()
    {
        return $this->morphOne(MovimientoAlmacen::class, 'documentoOrigen');
    }
    


}
