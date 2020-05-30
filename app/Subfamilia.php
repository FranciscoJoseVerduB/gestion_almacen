<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subfamilia extends Model
{
    protected $guarded = ['id',   'created_at', 'updated_at'];

    
    public function getRouteKeyName(){
        return 'codigo';
    }


    public function familia(){
        return $this->belongsTo(Familia::class);
    }
    public function productos(){
        return $this->hasMany(Producto::class);
    }
}
