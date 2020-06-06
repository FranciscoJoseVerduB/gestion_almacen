@extends('layouts.principal') 
 
@section('title', 'Recepciones')

@section('content') 
    <div class="container"> 


      @include('partials.crear-entidad', [
              'ruta' => 'recepciones',
              'texto' => 'Crear Recepcion', 
              'permisos' => 'modificarPanelRecepciones',
              'objeto' =>   App\Recepcion::class
          ])
  

        <table class="table  table-sm table-striped table-bordered table-hover shadow">
            <thead  class="bg-info text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Numero</th>  
                <th scope="col">Fecha</th>  
                <th scope="col">Proveedor</th>  
                <th scope="col">Lineas</th>  
                <th class=" text-center" scope="col" colspan="2">Operación</th>
              </tr>
            </thead>
            <tbody>
            @forelse($recepciones as $recepcion) 
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td> {{$recepcion->serie.'/'.$recepcion->numero}} </td> 
                <td> {{$recepcion->fecha}} </td>  
                <td> {{$recepcion->proveedor->sujeto->nombre}} </td>      
                <td> {{$recepcion->lineas->count()}} </td>    
                <td> <a class="btn btn-info btn-sm btn-block"
                        href="{{route('recepciones.ver-pdf', $recepcion)}}"
                    >Imprimir </td>  
                <td> <a class="btn btn-info btn-sm btn-block"
                        href="{{route('recepciones.show', $recepcion)}}"
                    >Ver </td> 
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


        {{ $recepciones->links()}}
</div>

@endsection