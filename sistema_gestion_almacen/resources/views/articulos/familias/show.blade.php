@extends('layouts.principal') 

@section('title', 'Familia | ' . $familia->codigo)

@section('content')
    <div class="container">
        <div class="bg-white p-5 shadow rounded">
 
    
            @include('partials._show-table', [
                'columnas' => [
                     'Codigo',
                     'Nombre', 
                     'Creado'
                    ],
                'filas'=> [
                        $familia->codigo,
                        $familia->nombre,   
                        $familia->created_at->diffForHumans()      
                    ]
             ])  
 
            
            @include('partials._show-operations', [
                        'ruta' => 'familias',
                        'objeto'=> $familia,
                        'permisos' => 'modificarPanelProductos' 
                    ]) 

        </div>
    </div>

    

@endsection
