@extends('layouts.principal') 

@section('title', 'Subfamilia | ' . $subfamilia->codigo)

@section('content')
    <div class="container">
        <div class="bg-white p-5 shadow rounded">
 
        @include('partials._show-table', [
                    'columnas' => [
                         'Codigo',
                         'Nombre',
                         'Familia',
                         'Creado'
                        ],
                    'filas'=> [
                            $subfamilia->codigo,
                            $subfamilia->nombre,
                            $subfamilia->familia->nombre,
                            $subfamilia->created_at->diffForHumans()

                        ]
          ])  


        
        @include('partials._show-operations', [
                    'ruta' => 'subfamilias',
                    'objeto'=> $subfamilia, 
                    'permisos' => 'modificarPanelProductos'
                ])  



        </div>
    </div>

    

@endsection
