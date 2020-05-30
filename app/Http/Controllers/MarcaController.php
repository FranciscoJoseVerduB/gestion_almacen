<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveMarcaRequest; 
use App\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('articulos.marcas.index',['marcas' => Marca::latest()->paginate(5)]);
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
        $marca->delete(); 
        return redirect()->route('marcas.index')->with('status', 'La marca fue eliminada con éxito');
    }
}
