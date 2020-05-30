<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveImpuestoRequest;
use App\Impuesto;
use Illuminate\Http\Request;

class ImpuestoController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('articulos.impuestos.index',['impuestos' => Impuesto::latest()->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view('articulos.impuestos.create', [
            'impuesto'=> new Impuesto,
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveImpuestoRequest $request)
    { 
        Impuesto::create($request->validated());

        return redirect()->route('impuestos.index')->with('status', 'El impuesto fue creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Impuesto  $impuesto
     * @return \Illuminate\Http\Response
     */
    public function show(Impuesto $impuesto)
    {
        return view('articulos.impuestos.show', [
            'impuesto' => $impuesto, 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Impuesto  $impuesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Impuesto $impuesto)
    {
        return view('articulos.impuestos.edit', [
            'impuesto' =>$impuesto, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Impuesto  $impuesto
     * @return \Illuminate\Http\Response
     */
    public function update(SaveImpuestoRequest $request, Impuesto $impuesto)
    { 
        $impuesto->update($request->validated());   
        return redirect()->route('impuestos.index')->with('status', 'El impuesto fue actualizada con éxito'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Impuesto  $impuesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Impuesto $impuesto)
    { 
        $impuesto->delete(); 
        return redirect()->route('impuestos.index')->with('status', 'El impuesto fue eliminada con éxito');     
    }
}
