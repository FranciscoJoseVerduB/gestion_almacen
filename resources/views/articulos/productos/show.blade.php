@extends('layouts.principal') 

@section('title', 'Producto | ' . $producto->codigo)

@section('content')
    <div class="container">
        <div class="bg-white p-5 shadow rounded">
    
            @include('partials._show-table', [
                'columnas' => [
                     'Codigo',
                     'Nombre',
                     'Subfamilia',
                     'Marca',
                     'Precio',
                     'Impuesto', 
                     'Creado'
                    ],
                'filas'=> [
                        $producto->codigo,
                        $producto->nombre,
                        $producto->subfamilia->nombre,
                        $producto->marca->nombre,
                        $producto->precio,
                        $producto->impuesto->nombre . '(' .$producto->impuesto->porcentaje.'%)', 
                        $producto->created_at->diffForHumans()      
                    ]
             ])  
  
 
            @include('partials._show-operations', ['ruta' => 'productos','objeto'=> $producto])   
        </div>
    </div>

    

@endsection
