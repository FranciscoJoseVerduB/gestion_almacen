

    
    @csrf
    <div class="form-group">
        <label for="codigo"> Código de la marca </label> 
        <input class="clase-cajatexto"
            id="codigo"
            type="text" 
            name="codigo" 
            value="{{old('codigo', $marca->codigo)}}">     
    </div>

    <div class="form-group">
        <label for="nombre"> Nombre de la marca </label> 
        <input class="clase-cajatexto"
            id="nombre"
            type="text" 
            name="nombre" 
            value="{{old('nombre', $marca->nombre)}}">     
    </div>   

    

<button class="btn btn-primary btn-lg btn-block"
    type="submit" 
    >{{$btnText}}
</button>
<a class="btn btn-link btn-block"
    href="{{ route('marcas.index') }}"
    >Cancelar   
</a>