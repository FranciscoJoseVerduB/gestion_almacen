<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckProducto;
use App\Http\Requests\SaveMarcaRequest; 
use App\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{

    private $numeroLinks = 15;

    public function __construct()
    { 
        $this->middleware('auth'); 
        $this->middleware(CheckProducto::class);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    { 
        $nombre = $request->get('buscarpor');

        return view('articulos.marcas.index',['marcas' => 
                            Marca::whereRaw(" UPPER(marcas.nombre) like UPPER('%".$nombre."%') or
                                                UPPER(marcas.codigo) like UPPER('%".$nombre."%')")
                                    ->orderBy('marcas.created_at', 'DESC')
                                    ->select('marcas.*')
                                    ->paginate($this->numeroLinks)] );   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulos.marcas.create', [
            'marca'=> new Marca,
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveMarcaRequest $request)
    {
        $this->authorize('modificarPanelProductos', Marca::class);


        Marca::create($request->validated()); 
        return redirect()->route('marcas.index')->with('status', 'La marca fue creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        return view('articulos.marcas.show', [
            'marca' => $marca
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        return view('articulos.marcas.edit', [
            'marca' =>$marca
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(SaveMarcaRequest $request, Marca $marca)
        {
            $this->authorize('modificarPanelProductos', $marca);


            $marca->update($request->validated()); 
            return redirect()->route('marcas.index')->with('status', 'La marca fue actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    { 
        $this->authorize('modificarPanelProductos', $marca);

        
        $puedeBorrarse = Marca::whereRaw('id in (select distinct marca_id from productos )')
                                ->where('id', '=', $marca->id)  
                                ->get() 
                                ->first();  
                                
        if($puedeBorrarse !== null)
        return redirect()->route('marcas.show', $marca)->with('status', 'La marca no puede eliminarse. Está siendo utilizado en algún producto');

        
        $marca->delete(); 
        return redirect()->route('marcas.index')->with('status', 'La marca fue eliminada con éxito');
    }
}
