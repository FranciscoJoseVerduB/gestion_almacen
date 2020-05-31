@extends('layouts.principal') 
 
@section('title', 'Pedidos de Compra')

@section('content')


    <div class="container"> 
        <div class="d-flex justify-content-between align-items-center mb-3"> 
            <h1 class="display-6 mb-0">@lang('Pedidos')</h1>

            @auth
            
            @endauth
             <div class="d-flex align-items-baseline">
                    <a class="btn btn-primary "
                        href="{{route('pedidos_compra.create')}}"
                    >Crear Pedido
                    </a>
            </div>
        </div>
 

        <table class="table  table-sm table-striped table-bordered table-hover shadow">
            <thead  class="bg-info text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Numero</th>
                <th scope="col">Estado</th> 
                <th scope="col">Fecha</th>  
                <th scope="col">Proveedor</th>  
                <th scope="col">Lineas</th>  
                <th class=" text-center" scope="col">Operación</th>
              </tr>
            </thead>
            <tbody>
            @forelse($pedidos_compra as $pedido_compra) 
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td> {{$pedido_compra->serie. '/'.$pedido_compra->numero}} </td>
                <td> {{$pedido_compra->estado->estado}} </td>  
                <td> {{$pedido_compra->fecha}} </td>  
                <td> {{$pedido_compra->proveedor->sujeto->nombre}} </td>      
                <td> {{$pedido_compra->lineas->count()}} </td>   
                <td> <a class="btn btn-info btn-sm btn-block"
                        href="{{route('pedidos_compra.show', $pedido_compra)}}"
                    >Ver Pedido </td> 
             </tr> 
              @empty
                <tr> 
                   <td class="text-center"
                     colspan="6"
                    >No hay pedidos que mostrar
                  </td> 
                </tr>
             @endforelse
            </tbody>
        </table>


        {{ $pedidos_compra->links()}}
</div>

@endsection