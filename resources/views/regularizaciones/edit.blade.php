@extends('layouts.principal')


@section('title', 'Regularizaciones Manuales')

@section('content')
  
<div class="container"> 
    <div class="form-row">
        <div class="col-12 col-sm-10 col-lg-11 mx-auto">
            @include('partials.validation-errors')
 
            <form class="clase-formulario"
                method="POST" 
                action="{{route('regularizaciones_manual.update', $regularizacion_manual)}}"
                > 
                @method('PATCH')
                
                <h1 class="display-6 show-texto">
                    Editar Regularización
                </h1>
                <hr> 
                @include('regularizaciones._form', ['btnText' => 'Editar'])
            </form>
        </div>
    </div>    
</div>

@endsection 
