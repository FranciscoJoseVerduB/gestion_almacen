@extends('layouts.principal') 

@section('title', 'Usuario | ' . $usuario->codigo)

@section('content')
    <div class="container">
        <div class="bg-white p-5 shadow rounded">
 

            @include('partials._show-table', [
                'columnas' => [
                     'Codigo',
                     'Nombre',
                     'Email', 
                     'Teléfono',
                     'Rol', 
                     'Creado'
                    ],
                'filas'=> [
                        $usuario->codigo,
                        $usuario->nombre, 
                        $usuario->telefono,
                        $usuario->email,
                        $usuario->rol->nombre,  
                        $usuario->created_at->diffForHumans()      
                    ]
             ])  
 
 
 
            @include('partials._show-operations', [
                    'ruta' => 'usuarios',
                    'objeto'=> $usuario, 
                    'permisos' => 'modificarPanelUsuarios'
                ])  


        </div>
    </div>

    

@endsection
