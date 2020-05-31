@extends('layouts.principal') 
 
@section('title', 'Regularizaciones Manuales')

@section('content') 
    <div class="container"> 
        <div class="d-flex justify-content-between align-items-center mb-3">  
            <div class="d-flex align-items-baseline">
                  <a class="btn btn-primary "
                      href="{{route('stocks.index')}}"
                  >Stock
                  </a>
            </div>

             <div class="d-flex align-items-baseline">
                    <a class="btn btn-primary "
                        href="{{route('regularizaciones_manual.create')}}"
                    >Crear Documento de Regularización
                    </a>
            </div>
        </div>
 

        <table class="table  table-sm table-striped table-bordered table-hover shadow">
            <thead  class="bg-info text-white">
              <tr>
                <th scope="col">#</th> 
                <th scope="col">Numero</th> 
                <th scope="col">Fecha</th>    
                <th scope="col">Almacen</th> 
                <th scope="col">Lineas</th>  
                <th class=" text-center" scope="col">Operación</th>
              </tr>
            </thead>
            <tbody>
            @forelse($regularizaciones_manual as $regularizacion_manual) 
            <tr>
                <th scope="row">{{$loop->iteration}}</th> 
                <td> {{$regularizacion_manual->serie.'/'.$regularizacion_manual->numero}} </td>  
                <td> {{$regularizacion_manual->fecha}} </td>  
                <td> {{$regularizacion_manual->almacen->sujeto->nombre}} </td>      
                <td> {{$regularizacion_manual->lineas->count()}} </td>   
                <td> <a class="btn btn-info btn-sm btn-block"
                        href="{{route('regularizaciones_manual.show', $regularizacion_manual)}}"
                    >Ver Regularización </td> 
             </tr> 
              @empty
                <tr> 
                   <td class="text-center"
                     colspan="7"
                    >No hay documentos de regularización que mostrar
                  </td> 
                </tr>
             @endforelse
            </tbody>
        </table>


        {{ $regularizaciones_manual->links()}}
</div>

@endsection