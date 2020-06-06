@extends('layouts.principal')


@section('title', 'Subfamilias')

@section('content')

<div class="container"> 
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto">
           
 
            @include('partials.validation-errors')

            <form class="clase-formulario"
                method="POST" 
                action="{{route('subfamilias.update', $subfamilia)}}"
                > 
                @method('PATCH')
                
                <h1 class="display-6 show-texto">
                    Editar subfamilia
                </h1>
                <hr> 
                @include('articulos.subfamilias._form', ['btnText' => 'Editar'])
            </form>
        </div>
    </div>    
</div>

@endsection 
