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

        $pedidoEstado1 = new PedidoCompraEstado([
            'estado' => 'Pendiente'
        ]); $pedidoEstado1->save();
 
        $pedidoEstado3 = new PedidoCompraEstado([
            'estado' => 'Anulado'
        ]);$pedidoEstado3->save();
        
        $pedidoEstado4 = new PedidoCompraEstado([
            'estado' => 'Servido'
        ]);$pedidoEstado4->save();
        

        $pedidoLineaEstado1  = new PedidoCompraLineaEstado([
            'estado' => 'Pendiente'
        ]); $pedidoLineaEstado1->save(); 
        $pedidoLineaEstado2  = new PedidoCompraLineaEstado([
            'estado' => 'ParcialmenteServido'
        ]); $pedidoLineaEstado2->save(); 
        $pedidoLineaEstado3  = new PedidoCompraLineaEstado([
            'estado' => 'Anulado'
        ]); $pedidoLineaEstado3->save(); 
        $pedidoLineaEstado4  = new PedidoCompraLineaEstado([
            'estado' => 'Servido'
        ]); $pedidoLineaEstado4->save();


        return view('articulos.index');
    }
}
