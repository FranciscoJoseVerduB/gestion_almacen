<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckStock;
use App\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{

    private $numeroLinks = 15;

    
    public function __construct()
    {
        $this->middleware(CheckStock::class);
    }
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $nombre = $request->get('buscarpor');

        return view('stocks.index',['stocks' => Stock::join('almacenes', 'almacen_id', '=', 'almacenes.id')
                    ->join('sujetos', 'sujeto_id', '=', 'sujetos.id')
                    ->join('productos', 'producto_id', '=', 'productos.id')
                    ->whereRaw("UPPER(productos.nombre) like  UPPER('%".$nombre."%') OR
                                UPPER(sujetos.nombre) like UPPER('%".$nombre."%')
                                ")
                     ->paginate($this->numeroLinks)] );
        
        // return view('stocks.index',['stocks' => Stock::orderBy('almacen_id')->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    { 
        return view('stocks.show', [
            'stock' => $stock 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
