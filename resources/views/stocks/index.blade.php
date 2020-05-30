@extends('layouts.principal') 
 
@section('title', 'Stock')

@section('content')


    <div class="container"> 
        <div class="d-flex justify-content-between align-items-center mb-3"> 
            <h1 class="display-6 mb-0">@lang('Stock')</h1>

            @auth
            
            @endauth
             <div class="d-flex align-items-baseline">
                    <a class="btn btn-primary "
                        href="{{route('regularizaciones_manual.index')}}"
                    >Regularizar stock
                    </a>
            </div>
        </div>
 

        <table class="table  table-sm table-striped table-bordered table-hover shadow">
            <thead  class="bg-info text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Almacen</th> 
                <th scope="col">Producto</th>  
                <th class=" text-center" scope="col">Operación</th>   
              </tr>
            </thead>
            <tbody>
            @forelse($stocks as $stock) 
            <tr>
                <th scope="row">{{$loop->iteration}}</th> 
                <td> {{$stock->cantidad}} </td>
                <td> {{$stock->almacen->sujeto->nombre}} </td>  
                <td> {{$stock->producto->codigo .' -- ' . $stock->producto->nombre}} </td>   
                <td> <a class="btn btn-info btn-sm btn-block"
                      href="{{route('stocks.show', $stock)}}"
                   >Ver Movimientos </td> 
             </tr> 
              @empty
                <tr> 
                   <td class="text-center"
                     colspan="7"
                    >No hay recepciones que mostrar
                  </td> 
                </tr>
             @endforelse
            </tbody>
        </table>


        {{ $stocks->links()}}
</div>

@endsection