@extends('layouts.principal') 
 
@section('title', 'Almacenes')

@section('content')
 
    <div class="container"> 

        @include('partials.crear-entidad', [
                    'ruta' => 'almacenes',
                    'texto' => 'Crear Almacen', 
                    'permisos' => 'modificarPanelAlmacenes',
                    'objeto' =>   App\Almacen::class
        ])
 

        <table class="table  table-sm table-striped table-bordered table-hover shadow">
            <thead  class="bg-info text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th> 
                <th scope="col">Provincia</th> 
                <th scope="col">Persona de Contacto</th> 
                <th class=" text-center" scope="col">Operación</th>
              </tr>
            </thead>
            <tbody>
            @forelse($almacenes as $almacen) 
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td> {{$almacen->codigo}} </td>
                <td> {{$almacen->sujeto->nombre . $almacen->sujeto->primerApellido . $almacen->sujeto->segundoApellido}} </td> 
                <td> {{$almacen->sujeto->direccion->provincia}}</td>
                <td> {{$almacen->sujeto->personaContacto}}</td>
                <td> <a class="btn btn-info btn-sm btn-block"
                        href="{{route('almacenes.show', $almacen)}}"
                    >Ver Almacen </td> 
             </tr> 
              @empty
              <tr> 
                  <td>No hay almacenes que mostrar</td>
              </tr>
          @endforelse
            </tbody>
        </table>
 
        {{ $almacenes->links()}}
</div>

@endsection