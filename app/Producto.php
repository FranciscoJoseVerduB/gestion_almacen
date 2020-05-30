<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
 

    protected $guarded = ['id',   'created_at', 'updated_at'];
    
    public function getRouteKeyName(){
        return 'codigo';
    }

    //Modulo Productos
 

    public function marca(){
        return $this->belongsTo(Marca::class);
    }
    
    public function subfamilia(){
        return $this->belongsTo(Subfamilia::class);
    }
    public function impuesto(){
        return $this->belongsTo(Impuesto::class);
    } 


    //Modulo Stock
    public function stock(){
        return $this->hasMany(Stock::class);
    }

    public function lineaPedido(){
        return $this->hasMany(PedidoCompraLinea::class);
    }
}
