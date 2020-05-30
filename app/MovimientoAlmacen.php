<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoAlmacen extends Model
{ 
    protected $table = 'movimientosalmacenes';
    protected $guarded = ['id',   'created_at', 'updated_at'];
 


    public function producto(){
        return $this->belongsTo(Producto::class);
    } 
    public function almacen(){
        return $this->belongsTo(Almacen::class);
    } 

    public function tipoMovimientoAlmacen(){
        return $this->belongsTo(TipoMovimientoAlmacen::class, 'tipoMovimientoAlmacen_id');
    }  

    public function documentoOrigen(){ 
        return $this->morphTo(); 
    }

    public function recepcionLinea(){  
        return $this->belongsTo(RecepcionLinea::class,'documentoOrigen_id', 'id' )
                                ->with('movimiento');
    } 

    public function pedidoLinea(){
        return $this->belongsTo(PedidoCompraLinea::class,'documentoOrigen_id', 'id' )
                                ->with('movimiento');
    }

    public function regularizacionLinea(){
        return $this->belongsTo(RegularizacionManualLinea::class,'documentoOrigen_id', 'id' )
                                ->with('movimiento');
    }


}
