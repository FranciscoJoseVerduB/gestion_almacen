@extends('layouts.principal') 

@section('title', 'Marca | ' . $marca->codigo)

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
                        $marca->codigo,
                        $marca->nombre, 
                        $marca->created_at->diffForHumans()      
                    ]
             ])  

          
            @include('partials._show-operations', ['ruta' => 'marcas','objeto'=> $marca])  
        </div>
    </div>

    

@endsection
