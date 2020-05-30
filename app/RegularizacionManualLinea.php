<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegularizacionManualLinea extends Model
{
    protected $guarded = ['id',   'created_at', 'updated_at']; 
    protected $table = 'regularizacionManualLineas';

    public function regularizacionManual(){
        return $this->hasOne(RegularizacionManual::class, 'id', 'regularizacionManual_id');     
    }


    public function producto(){
        return $this->belongsTo(Producto::class);     
    }
 
    public function movimiento()
    {
        return $this->morphOne(MovimientoAlmacen::class, 'documentoOrigen');
    }


}
