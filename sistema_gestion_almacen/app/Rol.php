<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{ 
    protected $table = 'roles';
    protected $guarded = ['id', 'created_at', 'updated_at'];
 

    
    public function getRouteKeyName(){
        return 'codigo';
    }

    public function user(){
        return $this->hasMany(User::class);
    }


    public function permisosRol(){
        return $this->belongsTo(PermisosRol::class, 'permisosRole_id');
    }


}
