@extends('layouts.principal')


@section('title', 'Roles')

@section('content')

<div class="container"> 
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto">
           
 
            @include('partials.validation-errors')

            <form class="clase-formulario"
                method="POST" 
                action="{{route('roles.update', $rol)}}"
                > 
                @method('PATCH')
                
                <h1 class="display-6 show-texto">
                    Editar rol
                </h1>
                <hr> 
                @include('usuarios.roles._form', ['btnText' => 'Editar'])
            </form>
        </div>
    </div>    
</div>

@endsection 
