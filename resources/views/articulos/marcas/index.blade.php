@extends('layouts.principal') 


@section('title', 'Marcas')

@section('content') 
    <div class="container"> 

        @include('partials.crear-entidad', [
                    'ruta' => 'marcas',
                    'texto' => 'Crear Marca', 
                    'permisos' => 'modificarPanelProductos'
        ])
 
     
            <table class="table  table-sm table-striped table-bordered table-hover shadow">
                <thead  class="bg-info text-white">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th> 
                    <th class=" text-center" scope="col">Operación</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($marcas as $marca) 
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td> {{$marca->codigo}} </td>
                        <td> {{$marca->nombre}} </td> 
                        <td> <a class="btn btn-info btn-sm btn-block"
                                href="{{route('marcas.show', $marca)}}"
                            >Ver Marca </td> 
                    </tr> 
                 @empty
                    <tr> 
                       <td colspan="4">No hay marcas que mostrar</td> 
                    </tr>
                 @endforelse
                </tbody>
            </table>
 
        {{ $marcas->links()}}
</div>

@endsection