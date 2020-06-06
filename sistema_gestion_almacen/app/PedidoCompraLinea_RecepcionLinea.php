<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoCompraLinea_RecepcionLinea extends Model
{
    protected $fillable = ['pedidoCompraLinea_id', 'recepcionLinea_id']; 
    protected $table = 'pedidocompralinea_recepcionlinea';


  public function pedidoLinea(){
        return $this->belongsTo(PedidoCompraLinea::class,'id', 'pedidoCompraLinea_id');     
    } 
  public function pedidoRecepcionLinea(){
        return $this->belongsTo(RecepcionLinea::class,'id', 'recepcionLinea_id');     
    }
}
