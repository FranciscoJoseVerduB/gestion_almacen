<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaveMovimiento extends Model
{
    protected $table = 'clavesmovimientos';
 
    protected $guarded = ['id',   'created_at', 'updated_at'];
 
}
