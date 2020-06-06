<?php

namespace App\Http\Controllers;

use App\ClaveMovimiento;
use App\PedidoCompraEstado;
use App\PedidoCompraLinea;
use App\PedidoCompraLineaEstado;
use App\TipoMovimientoAlmacen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticuloController extends Controller
{
    
  
    
    public function index(){ 
        return view('articulos.index');
    }
}
