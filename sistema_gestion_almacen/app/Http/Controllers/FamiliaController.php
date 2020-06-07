<?php

namespace App\Http\Controllers;

use App\Familia;
use App\Http\Middleware\CheckProducto;
use App\Http\Requests\SaveFamiliaRequest;
use FamiliaSeeder;
use Illuminate\Http\Request;

class FamiliaController extends Controller
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

        return view('articulos.familias.index',['familias' => 
                    Familia::whereRaw(" UPPER(familias.nombre) like UPPER('%".$nombre."%') OR
                                            UPPER(familias.codigo) like UPPER('%".$nombre."%')")
                            ->orderBy('familias.created_at', 'DESC')
                            ->select('familias.*')
                            ->paginate($this->numeroLinks)] ); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('articulos.familias.create', [
            'familia'=> new Familia,
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveFamiliaRequest $request)
    { 
        $this->authorize('modificarPanelProductos', Familia::class);

        Familia::create($request->validated()); 
        return redirect()->route('familias.index')->with('status', 'La familia fue creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function show(Familia $familia)
    {
        return view('articulos.familias.show', [
            'familia' => $familia
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function edit(Familia $familia)
    { 
        return view('articulos.familias.edit', [
            'familia' =>$familia
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function update(SaveFamiliaRequest $request, Familia $familia)
    { 
        $this->authorize('modificarPanelProductos', $familia);

        $familia->update($request->validated()); 
        return redirect()->route('familias.index')->with('status', 'La familia fue actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Familia $familia)
    { 
        $this->authorize('modificarPanelProductos', $familia);

        $puedeBorrarse = Familia::whereRaw('id in (select distinct familia_id from subfamilias )')
                            ->where('id', '=', $familia->id)  
                            ->get() 
                            ->first();  
                            
        if($puedeBorrarse !== null)
            return redirect()->route('familias.show', $familia)->with('status', 'La familia no puede eliminarse. Está siendo utilizado en alguna subfamilia');



        $familia->delete(); 
        return redirect()->route('familias.index')->with('status', 'La familia fue eliminada con éxito');
    }
}
