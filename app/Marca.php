<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{  
    protected $guarded = ['id',   'created_at', 'updated_at'];
    

    public function getRouteKeyName(){
        return 'codigo';
    }


    public function productos(){
        return $this->hasOne(Producto::class);
    }
}
