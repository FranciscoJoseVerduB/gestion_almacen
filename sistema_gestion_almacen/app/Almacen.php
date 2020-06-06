<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacenes'; 
    protected $guarded = ['id',   'created_at', 'updated_at'];
 
        
    public function getRouteKeyName(){
        return 'codigo';
    }

    public function sujeto(){
        return $this->belongsTo(Sujeto::class);
    }
    
    public function geolocalizacion(){
        return $this->belongsTo(Geolocalizacion::class);
    }


    public function stock(){
        return $this->hasOne(Stock::class);
    }

}
