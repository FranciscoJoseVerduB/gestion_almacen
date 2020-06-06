<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sujeto extends Model
{
    protected $guarded = ['id',   'created_at', 'updated_at'];


    public function proveedor(){
        return $this->hasOne(Proveedor::class);
    }

    public function almacen(){
        return $this->hasOne(Almacen::class);
    }

    
    public function direccion(){
        return $this->belongsTo(Direccion::class);
    }
}
