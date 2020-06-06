<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    protected $table = 'recepciones';
    protected $guarded = ['id',   'created_at', 'updated_at'];

    
    public function getRouteKeyName(){
        return 'id';
    }

    

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    } 
    
    public function almacen(){
        return $this->belongsTo(Almacen::class, 'almacen_id');
    } 

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
    
    public function lineas(){
        return $this->hasMany(RecepcionLinea::class, 'recepcion_id');     
    }

    
}
