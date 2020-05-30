@extends('layouts.principal')
 
@section('title', 'Productos')

@section('content')

<div class="container"> 
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto"> 

            @include('partials.validation-errors')

            <form class="clase-formulario"
                method="POST" 
                action="{{route('productos.update', $producto)}}"
                > 
                @method('PATCH')
                
                <h1 class="display-6 show-texto">
                    Editar producto
                </h1>
                <hr> 
                @include('articulos.productos._form', ['btnText' => 'Editar'])
            </form>
        </div>
    </div>    
</div>

@endsection 
