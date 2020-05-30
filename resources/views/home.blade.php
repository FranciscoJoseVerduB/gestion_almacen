@extends('layouts.principal')

@section('title', 'Home')

@section('content')

    <div class="container">
        <div class="row py-4"> 
            <div class="col-12 col-lg-6 shadow-sm py-4">
                <h1 class="display-6 text-primary " >Gestionalo </h1> 
                <p class="lead text-secondary">Gestiona tu almacén cómodamente</p>
                <a class="btn btn-lg btn-block btn-outline-dark shadow-sm"
                    href="{{ route('articulos') }}" 
                    >Articulos 
                </a>
                <a class="btn btn-lg btn-block  btn-outline-dark shadow-sm"
                    href="{{ route('productos.index') }}"
                    >Productos
                </a>
            </div>
            <!--
            <div class="col-12 col-lg-6">
                <img class="img-fluid mb-4" 
                    src="/img/home.svg" 
                    alt="Desarrollo Web">
            </div>
        -->
        <div class="col-12 col-lg-6 p-4">
            <img class="img-fluid mb-4" 
                src="/img/icono-gestionalo.png"
                alt="Gestionalo">
        </div>

        </div>
    </div>
 
@endsection