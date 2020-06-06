@extends('layouts.principal')


@section('title', 'Recepcion')

@section('content')
  
<div class="container-fluid"> 
    <div class="form-row">
        <div class="col-12 col-sm-10 col-lg-11 mx-auto">
            @include('partials.validation-errors')
 
            <form class="clase-formulario"
                method="POST" 
                action="{{route('recepciones.update', $recepcion)}}"
                > 
                @method('PATCH')
                
                <h1 class="display-6 show-texto">
                    Editar Recepcion
                </h1>
                <hr> 
                @include('recepciones._form', ['btnText' => 'Editar'])
            </form>
        </div>
    </div>    
</div>

@endsection 
