@extends('layouts.principal') 
 
@section('title', 'Usuarios')

@section('content')


    <div class="container"> 
        <div class="d-flex justify-content-between align-items-center mb-3"> 
            <h1 class="display-6 mb-0">@lang('Usuarios')</h1>

            @auth
            
            @endauth
             <div class="d-flex align-items-baseline">
                    <a class="btn btn-primary float-right mr-2"
                        href="{{route('roles.index')}}"
                    >Roles disponibles
                    </a>
                    <a class="btn btn-primary "
                        href="{{route('usuarios.create')}}"
                    >Crear usuario
                    </a>
            </div>
        </div>
 

        <table class="table  table-sm table-striped table-bordered table-hover shadow">
            <thead  class="bg-info text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th> 
                <th scope="col">Rol</th>  
                <th class=" text-center" scope="col">Operación</th>
              </tr>
            </thead>
            <tbody>
            @forelse($usuarios as $usuario) 
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td> {{$usuario->codigo}} </td>
                <td> {{$usuario->nombre}} </td>  
                <td> {{$usuario->rol->nombre}} </td>      
                <td> <a class="btn btn-info btn-sm btn-block"
                        href="{{route('usuarios.show', $usuario)}}"
                    >Ver Usuario </td> 
             </tr> 
              @empty
                <tr> 
                   <td colspan="5">No hay usuarios que mostrar</td> 
                </tr>
             @endforelse
            </tbody>
        </table>


        {{ $usuarios->links()}}
</div>

@endsection