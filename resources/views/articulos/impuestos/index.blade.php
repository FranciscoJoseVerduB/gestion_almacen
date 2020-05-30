@extends('layouts.principal') 


@section('title', 'Impuestos')

@section('content')
 
    <div class="container"> 
        <div class="d-flex justify-content-between align-items-center mb-3"> 
            <h1 class="display-6 mb-0">@lang('Impuestos')</h1>

            @auth
            
            @endauth
                <a class="btn btn-primary "
                    href="{{route('impuestos.create')}}"
                >Crear Impuesto
                </a>
        </div>

 

        <table class="table  table-sm table-striped table-bordered table-hover shadow">
            <thead  class="bg-info text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th> 
                <th scope="col">Porcentaje</th> 
                <th class=" text-center" scope="col">Operación</th>
              </tr>
            </thead>
            <tbody>
            @forelse($impuestos as $impuesto) 
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td> {{$impuesto->codigo}} </td>
                    <td> {{$impuesto->nombre}} </td> 
                    <td> {{$impuesto->porcentaje}}% </td> 
                    <td> <a class="btn btn-info btn-sm btn-block"
                            href="{{route('impuestos.show', $impuesto)}}"
                        >Ver Impuesto </td> 
                </tr> 
             @empty
                <tr> 
                    <td colspan="5">No hay impuestos que mostrar</td>
                </tr>
             @endforelse
            </tbody>
        </table>



        {{ $impuestos->links()}}
</div>

@endsection