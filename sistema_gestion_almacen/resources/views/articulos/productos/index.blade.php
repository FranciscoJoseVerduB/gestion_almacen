@extends('layouts.principal') 


@section('title', 'Productos')

@section('content') 
    <div class="container"> 

        @include('partials.crear-entidad', [
                    'ruta' => 'productos',
                    'texto' => 'Crear Produto', 
                    'permisos' => 'modificarPanelProductos',
                    'objeto' =>   App\Producto::class
        ])
 
            <table class="table  table-sm table-striped table-bordered table-hover shadow">
                <thead  class="bg-info text-white">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Subfamilia</th> 
                    <th scope="col">Marca</th> 
                    <th class=" text-center" scope="col">Operación</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($productos as $producto) 
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td> {{$producto->codigo}} </td>
                        <td> {{$producto->nombre}} </td>
                        <td>{{$producto->subfamilia->nombre}}</td> 
                        <td> {{$producto->marca->nombre}} </td>
                        <td> <a class="btn btn-info btn-sm btn-block"
                                href="{{route('productos.show', $producto)}}"
                            >Ver Producto </td> 
                    </tr> 
                 @empty
                    <tr> 
                        <td colspan="6">No hay productos que mostrar</td>
                    </tr>
                 @endforelse
                </tbody>
            </table>

 
        {{ $productos->links()}}
</div>

@endsection