<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{ 
    protected $table = 'proveedores'; 
    protected $guarded = ['id',   'created_at', 'updated_at'];
     

    public function getRouteKeyName(){
        return 'codigo';
    }


    public function sujeto(){
        return $this->belongsTo(Sujeto::class);
    }
}
