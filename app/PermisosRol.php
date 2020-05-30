<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermisosRol extends Model
{
    protected $table = 'permisosroles';
 
    protected $guarded = ['id',   'created_at', 'updated_at'];
 
 
    
    public function getRouteKeyName(){
        return 'codigo';
    }


    public function rol(){
        return $this->hasOne(Rol::class);     
    }

}
