<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
     
    protected $guarded = ['id',   'created_at', 'updated_at'];
 
        
    public function getRouteKeyName(){
        return 'codigo';
    }
    
    public function subfamilias(){
        return $this->hasMany(Subfamilia::class);
    }
}
