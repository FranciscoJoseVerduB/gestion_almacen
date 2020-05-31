@extends('layouts.principal') 


@section('title', 'Familias')

@section('content')  
    <div class="container">

        @include('partials.crear-entidad', [
                    'ruta' => 'familias',
                    'texto' => 'Crear Familia', 
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
            @forelse($familias as $familia) 
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td> {{$familia->codigo}} </td>
                    <td> {{$familia->nombre}} </td>  
                    <td> <a class="btn btn-info btn-sm btn-block"
                            href="{{route('familias.show', $familia)}}"
                        >Ver Familia </td> 
                </tr> 
             @empty
                <tr> 
                    <td colspan="4">No hay familias que mostrar</td>
                </tr>
             @endforelse
            </tbody>
        </table> 
        {{ $familias->links()}}
</div>

@endsection