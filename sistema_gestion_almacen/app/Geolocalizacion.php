<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geolocalizacion extends Model
{
    protected $table = 'geolocalizaciones';
    protected $guarded = ['id',   'created_at', 'updated_at'];
 

    public function almacen(){
        return $this->hasOne(Almacen::class);
    }

}
