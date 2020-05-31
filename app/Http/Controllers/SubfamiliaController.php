<?php

namespace App\Http\Controllers;

use App\Subfamilia;
use App\Familia;
use App\Http\Middleware\CheckProducto;
use App\Http\Requests\SaveSubfamiliaRequest;
use Illuminate\Http\Request;

class SubfamiliaController extends Controller
{
    

    public function __construct()
    {
        $this->middleware(CheckProducto::class);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('articulos.subfamilias.index',['subfamilias' => Subfamilia::latest()->paginate(5)]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulos.subfamilias.create', [
            'subfamilia'=> new Subfamilia,
        ]);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveSubfamiliaRequest $request)
    { 
        $this->authorize('modificarPanelProductos', new Subfamilia);

        Subfamilia::create($request->validated()); 
        return redirect()->route('subfamilias.index')->with('status', 'La subfamilia fue creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subfamilia  $subfamilia
     * @return \Illuminate\Http\Response
     */
    public function show(Subfamilia $subfamilia)
    {
        return view('articulos.subfamilias.show', [
            'subfamilia' => $subfamilia,
            'familias' => Familia::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subfamilia  $subfamilia
     * @return \Illuminate\Http\Response
     */
    public function edit(Subfamilia $subfamilia)
    {  
        return view('articulos.subfamilias.edit', [
            'subfamilia' =>$subfamilia,
            'familias' => Familia::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subfamilia  $subfamilia
     * @return \Illuminate\Http\Response
     */
    public function update(SaveSubfamiliaRequest $request, Subfamilia $subfamilia)
    { 
        $this->authorize('modificarPanelProductos', $subfamilia);
        
        $subfamilia->update($request->validated());   
        return redirect()->route('subfamilias.index')->with('status', 'La subfamilia fue actualizada con éxito'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subfamilia  $subfamilia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subfamilia $subfamilia)
    { 
        $this->authorize('modificarPanelProductos', $subfamilia);
        
        $subfamilia->delete(); 
        return redirect()->route('subfamilias.index')->with('status', 'La subfamilia fue eliminada con éxito');    }
}
