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
                     'VerP.Recursos', 
                     'Creado'
                    ],
                'filas'=> [
                        $rol->codigo,
                        $rol->nombre,
                        $rol->permisosRol->permisoAdministrador? 'SI': 'NO', 
                        $rol->permisosRol->verPanelRecursos? 'SI': 'NO', 
                        $rol->created_at->diffForHumans()      
                    ]
             ])  
 
            @include('partials._show-table', [
                'columnas' => [
                     'VerP.Productos',
                     'MP.Productos',
                     'Ver.Usuarios',
                     'M.P.Usuarios',
                     'Ver.Pedidos',
                     'M.P.Pedidos',
                    ],
                'filas'=> [
                    
                        $rol->permisosRol->verPanelProductos? 'SI': 'NO', 
                        $rol->permisosRol->modificarPanelProductos? 'SI': 'NO', 
                        $rol->permisosRol->verPanelUsuarios? 'SI': 'NO',
                        $rol->permisosRol->modificarPanelUsuarios? 'SI': 'NO',
                        $rol->permisosRol->verPanelPedidos? 'SI': 'NO',
                        $rol->permisosRol->modificarPanelPedidos? 'SI': 'NO',
                    ]
             ])  
            
            @include('partials._show-table', [
                'columnas' => [ 
                     'VerP.Recepciones', 
                     'M.P.Recepciones', 
                     'VerP.Stock',
                     'M.P.Stock', 
                    ],
                'filas'=> [ 
                        $rol->permisosRol->verPanelRecepciones? 'SI': 'NO', 
                        $rol->permisosRol->modificarPanelRecepciones? 'SI': 'NO', 
                        $rol->permisosRol->verPanelStock? 'SI': 'NO',
                        $rol->permisosRol->modificarPanelStock? 'SI': 'NO', 
                    ]
             ]) 


@include('partials._show-table', [
                'columnas' => [ 
                     'VerP.Almacenes',
                     'M.P.Almacenes',
                     'VerP.Proveedores',
                     'M.P.Proveedores'
                    ],
                'filas'=> [ 
                        $rol->permisosRol->verPanelAlmacenes? 'SI': 'NO',
                        $rol->permisosRol->modificarPanelAlmacenes? 'SI': 'NO',
                        $rol->permisosRol->verPanelProveedores? 'SI': 'NO',
                        $rol->permisosRol->modificarPanelProveedores? 'SI': 'NO',
                    ]
             ]) 
            
            @include('partials._show-operations', [
                        'ruta' => 'roles',
                        'objeto'=> $rol, 
                        'permisos' => 'modificarPanelUsuarios'
                    ])  


        </div>
    </div>

    

@endsection
