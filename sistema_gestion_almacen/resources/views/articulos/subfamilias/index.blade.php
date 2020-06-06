@extends('layouts.principal') 


@section('title', 'Subfamilias')

@section('content') 
    <div class="container"> 
        <div class="d-flex justify-content-between align-items-center mb-3">  

            <div class="d-flex align-items-baseline">
                <a class="btn btn-primary  mr-2"
                    href="{{route('familias.index')}}"
                >Ver Familias disponibles
                </a>
            </div>
                @can('modificarPanelProductos',   App\Subfamilia::class)
                    <div class="d-flex align-items-baseline ">  
                        <a class="btn btn-primary "
                            href="{{route('subfamilias.create')}}"
                        >Crear Subfamilia
                        </a>
                    </div>
                @endcan 
        </div>
 
     
        <table class="table  table-sm table-striped table-bordered table-hover shadow">
            <thead  class="bg-info text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th> 
                <th scope="col">Familia</th> 
                <th class=" text-center" scope="col">Operación</th>
              </tr>
            </thead>
            <tbody>
            @forelse($subfamilias as $subfamilia) 
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td> {{$subfamilia->codigo}} </td>
                    <td> {{$subfamilia->nombre}} </td> 
                    <td>  {{$subfamilia->familia->nombre}} </td>
                    <td> <a class="btn btn-info btn-sm btn-block"
                            href="{{route('subfamilias.show', $subfamilia)}}"
                        >Ver Subfamilia </td> 
                </tr> 
             @empty
                <tr> 
                    <td colspan="5">No hay subfamilias que mostrar</td>
                </tr>
             @endforelse
            </tbody>
        </table>


        {{ $subfamilias->links()}}
</div>

@endsection