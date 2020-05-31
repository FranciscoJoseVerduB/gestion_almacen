@extends('layouts.principal') 
 
@section('title', 'Roles')

@section('content') 

    <div class="container"> 

        <div class="d-flex justify-content-between align-items-center mb-3">  
            <div class="d-flex align-items-baseline">
                <a class="btn btn-primary float-right mr-2"
                    href="{{route('usuarios.index')}}"
                >Ver usuarios
                </a>
                @can('modificarPanelUsuarios',  App\User::class)
                    <a class="btn btn-primary "
                        href="{{route('roles.create')}}"
                    >Crear rol
                    </a>
                @endcan
            </div>
            
        </div>
 

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
            @forelse($roles as $rol) 
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td> {{$rol->codigo}} </td>
                <td> {{$rol->nombre}} </td> 
                <td> <a class="btn btn-info btn-sm btn-block"
                        href="{{route('roles.show', $rol)}}"
                    >Ver Rol </td>

             </tr> 
              @empty
              <tr> 
                  <td colspan="4">No hay roles que mostrar</td>
              </tr>
          @endforelse
            </tbody>
        </table>
 
        {{ $roles->links()}}
</div>

@endsection