@extends('layouts.principal') 
 
@section('title', 'Proveedores')

@section('content')
 
    <div class="container"> 
        <div class="d-flex justify-content-between align-items-center mb-3"> 
            <h1 class="display-6 mb-0">@lang('Proveedores')</h1>

            @auth
            
            @endauth 
            
            <a class="btn btn-primary "
                href="{{route('proveedores.create')}}"
            >Crear Proveedor
            </a> 
            
        </div>
 

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
            @forelse($proveedores as $proveedor) 
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td> {{$proveedor->codigo}} </td>
                <td> {{$proveedor->sujeto->nombre . $proveedor->sujeto->primerApellido . $proveedor->sujeto->segundoApellido}} </td> 
                <td> {{$proveedor->sujeto->direccion->provincia}}</td>
                <td> {{$proveedor->sujeto->personaContacto}}</td>
                <td> <a class="btn btn-info btn-sm btn-block"
                        href="{{route('proveedores.show', $proveedor)}}"
                    >Ver Proveedor </td> 
             </tr> 
              @empty
              <tr> 
                  <td colspan="6">No hay proveedores que mostrar</td>
              </tr>
          @endforelse
            </tbody>
        </table>
 
        {{ $proveedores->links()}}
</div>

@endsection