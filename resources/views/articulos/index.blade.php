@extends('layouts.principal') 


@section('title', 'Articulos')

@section('content')
 
    <div class="container text-center shadow-lg"> 
        <div class="list-group list-group-horizontal"> 
                <a href="#" 
                    class="list-group-item list-group-item-action list-group-item-light active">
                Articulos
                </a> 
            <div class="dropdown-divider dropdown-item-text "></div>
            <a class="list-group-item list-group-item-action shadow-sm" href="{{route('impuestos.index')}}">Impuestos</a>  
            <a class="list-group-item list-group-item-action shadow-sm" href="{{route('familias.index')}}">Familias</a>
            <a class="list-group-item list-group-item-action shadow-sm"href="{{route('marcas.index')}}">Marcas</a> 
            <a class="list-group-item list-group-item-action shadow-sm" href="{{route('productos.index')}}">Productos</a>
            <a class="list-group-item list-group-item-action shadow-sm" href="{{route('subfamilias.index')}}">Subfamilias</a>
            <div class="dropdown-divider dropdown-item-text "></div>
         
        </div>
    </div>

@endsection