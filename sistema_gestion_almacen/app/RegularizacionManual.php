<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegularizacionManual extends Model
{
    protected $table = 'regularizacionesManuales';
    protected $guarded = ['id', 'created_at', 'updated_at'];
 
    
    
    public function almacen(){
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function lineas(){
        return $this->hasMany(RegularizacionManualLinea::class, 'regularizacionManual_id');     
    }

    

}
