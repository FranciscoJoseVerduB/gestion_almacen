@extends('layouts.principal') 

@section('title', 'Rol | ' . $rol->codigo)

@section('content')
    <div class="container">
        <div class="bg-white p-5 shadow rounded">
 

            @include('partials._show-table', [
                'columnas' => [
                     'Codigo',
                     'Nombre',   
                     'permisoAdministrador',
                     'Creado'
                    ],
                'filas'=> [
                        $rol->codigo,
                        $rol->nombre,
                        $rol->permisosRol->permisoAdministrador? 'SI': 'NO', 
                        $rol->created_at->diffForHumans()      
                    ]
             ])  
 
            @include('partials._show-table', [
                'columnas' => [
                     'ModificarDatosMaestros',
                     'VerPanelRecursos', 
                     'VerPanelUsuarios',
                     'VerPanelPedidos',
                    ],
                'filas'=> [
                    
                        $rol->permisosRol->modificarDatosMaestros? 'SI': 'NO', 
                        $rol->permisosRol->verPanelRecursos? 'SI': 'NO',
                        $rol->permisosRol->verPanelUsuarios? 'SI': 'NO',
                        $rol->permisosRol->verPanelPedidos? 'SI': 'NO',
                    ]
             ])  
            
            @include('partials._show-table', [
                'columnas' => [ 
                     'VerPanelRecepciones', 
                     'VerPanelStock',
                     'VerPanelAlmacenes',
                     'VerPanelProveedores'
                    ],
                'filas'=> [ 
                        $rol->permisosRol->verPanelRecepciones? 'SI': 'NO', 
                        $rol->permisosRol->verPanelStock? 'SI': 'NO',
                        $rol->permisosRol->verPanelAlmacenes? 'SI': 'NO',
                        $rol->permisosRol->verPanelProveedores? 'SI': 'NO',
                    ]
             ]) 
            
            @include('partials._show-operations', ['ruta' => 'roles','objeto'=> $rol])  
        </div>
    </div>

    

@endsection
