@extends('layouts.principal')

 

@section('title', 'Pedidos Compra') 
 
@section('content') 

    <div class="container-fluid">
        <div class="form-row">
            <div class="col-12 col-sm-10 col-lg-11 mx-auto">
                 
                @include('partials.validation-errors')

                <form class="clase-formulario"
                    method="POST" 
                    action="{{route('pedidos_compra.store')}}"
                    >
                    
                    <h1 class="display-6 show-texto">Nuevo Pedido</h1>
                    <hr>
                    @include('pedidos._form', ['btnText' => 'Guardar'])  
                </form>

            </div>
        </div> 
    </div>

    


@endsection 