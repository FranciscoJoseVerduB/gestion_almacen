<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{


    
    public function getRouteKeyName(){
        return 'url';
    }


    public function almacen(){
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }
    
    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    public function movimientos(){
        return $this->hasMany(MovimientoAlmacen::class, 'almacen_id',  'almacen_id')
                            ->where('producto_id', '=', $this->producto_id); 
    }
}
