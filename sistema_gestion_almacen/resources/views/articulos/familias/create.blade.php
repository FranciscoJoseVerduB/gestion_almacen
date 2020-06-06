@extends('layouts.principal')


@section('title', 'Familias')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-6 mx-auto">
                 
                @include('partials.validation-errors')

                <form class="clase-formulario"
                    method="POST" 
                    action="{{route('familias.store')}}"
                    >
                    
                    <h1 class="display-6 show-texto">Nueva Familia</h1>
                    <hr>
                    @include('articulos.familias._form', ['btnText' => 'Guardar'])  
                </form>

            </div>
        </div> 
    </div>

    


@endsection 