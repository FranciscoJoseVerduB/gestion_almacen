<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direcciones';
     
    protected $guarded = ['id',   'created_at', 'updated_at'];
 

    public function sujeto(){
        return $this->hasOne(Sujeto::class);
    }
}
