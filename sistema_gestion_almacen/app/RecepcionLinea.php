<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecepcionLinea extends Model
{
    protected $guarded = ['id',   'created_at', 'updated_at']; 
    protected $table = 'recepcionlineas';
 
    
    public function recepcion(){
        return $this->hasOne(Recepcion::class, 'id', 'recepcion_id');     
    }
     

    public function producto(){
        return $this->belongsTo(Producto::class);     
    }
    
    public function pedidoLineaPivot(){ 
        return $this->hasOne(PedidoCompraLinea_RecepcionLinea::class, 'recepcionLinea_id', 'id');
    }

    
    public function movimiento()
    {
        return $this->morphOne(MovimientoAlmacen::class, 'documentoOrigen');
    }
  
}
