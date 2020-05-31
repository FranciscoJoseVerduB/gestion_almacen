@extends('layouts.principal') 

@section('title', 'Impuesto | ' . $impuesto->codigo)

@section('content')
    <div class="container">
        <div class="bg-white p-5 shadow rounded">
  
 
            @include('partials._show-table', [
                'columnas' => [
                     'Codigo',
                     'Nombre',
                     'Porcentaje', 
                     'Creado'
                    ],
                'filas'=> [
                        $impuesto->codigo,
                        $impuesto->nombre,  
                        $impuesto->porcentaje.'%', 
                        $impuesto->created_at->diffForHumans()      
                    ]
             ])  

            @include('partials._show-operations', [
                        'ruta' => 'impuestos',
                        'objeto'=> $impuesto,
                        'permisos' => 'modificarPanelProductos'
                    ])  


        </div>
    </div>

    

@endsection
