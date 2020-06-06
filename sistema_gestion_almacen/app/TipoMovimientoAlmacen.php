<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoMovimientoAlmacen extends Model
{
    protected $table = 'tiposmovimientosalmacenes';
      
    protected $guarded = ['id',   'created_at', 'updated_at'];
 
}
