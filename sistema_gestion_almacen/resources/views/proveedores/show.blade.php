@extends('layouts.principal') 

@section('title', 'Proveedor | ' . $proveedor->codigo)

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
                $proveedor->codigo,
                $proveedor->sujeto->nombre .' '. $proveedor->sujeto->primerApellido . ' ' . $proveedor->sujeto->segundoApellido,
                $proveedor->sujeto->nif,
                $proveedor->sujeto->email,
                $proveedor->sujeto->personaContacto,
                $proveedor->sujeto->paginaWeb,
                $proveedor->created_at->diffForHumans()      
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
            $proveedor->sujeto->direccion->direccion,
            $proveedor->sujeto->direccion->codigoPostal,
            $proveedor->sujeto->direccion->poblacion,
            $proveedor->sujeto->direccion->provincia,
            $proveedor->sujeto->direccion->pais,       
        ]
])  



  
            
            @include('partials._show-operations', [
                        'ruta' => 'proveedores',
                        'objeto'=> $proveedor, 
                        'permisos' => 'modificarPanelProveedores'
                    ])  
        </div>
    </div>

    

@endsection
