<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoCompraLineaEstado extends Model
{
    protected $guarded = ['id',   'created_at', 'updated_at'];
    protected $table = 'pedidocompralineaestados';
 
    
    public function linea(){
        return $this->hasOne(PedidoCompraLinea::class);     
    }

 
    public function estado(){
        return $this->belongsTo(PedidoCompraLineaEstados::class, 'lineaPedidoEstado_id');     
    }
    

}
