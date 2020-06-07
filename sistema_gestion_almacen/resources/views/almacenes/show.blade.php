@extends('layouts.principal') 

@section('title', 'Almacen | ' . $almacen->codigo)

@section('content')
    <div class="container-fluid">
        <div class="bg-white p-5 shadow rounded sm-show"> 


<!-- Datos principales -->

    @include('partials._show-table', [
        'columnas' => [
            'Codigo',
            'Nombre', 
            'NIF',
            'Email',
            'Persona de Contacto', 
            'Página web', 
            'Creado', 
            ],
        'filas'=> [
                $almacen->codigo,
                $almacen->sujeto->nombre . ' '.  $almacen->sujeto->primerApellido . ' '. $almacen->sujeto->segundoApellido,
                $almacen->sujeto->nif,
                $almacen->sujeto->email,
                $almacen->sujeto->personaContacto,
                $almacen->sujeto->paginaWeb,
                $almacen->created_at->diffForHumans()      
            ]
    ])  
            
<!-- Otra información -->
 
@include('partials._show-table', [
    'columnas' => [
        'Direccion', 
        'Codigo Postal',
        'Poblacion', 
        'Provincia',
        'País',
        ],
    'filas'=> [
            $almacen->sujeto->direccion->direccion,
            $almacen->sujeto->direccion->codigoPostal,
            $almacen->sujeto->direccion->poblacion,
            $almacen->sujeto->direccion->provincia,
            $almacen->sujeto->direccion->pais,       
        ]
])  



  
            
            @include('partials._show-operations', [
                        'ruta' => 'almacenes',
                        'objeto'=> $almacen, 
                        'permisos' => 'modificarPanelAlmacenes'
                    ])  


        </div>
    </div>

    

@endsection
