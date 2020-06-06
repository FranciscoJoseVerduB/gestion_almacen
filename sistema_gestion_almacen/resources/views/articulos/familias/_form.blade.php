

    
    @csrf
    <div class="form-group">
        <label for="codigo"> Código de la familia </label> 
        <input class="clase-cajatexto"
            id="codigo"
            type="text" 
            name="codigo" 
            value="{{old('codigo', $familia->codigo)}}">     
    </div>

    <div class="form-group">
        <label for="nombre"> Nombre de la familia </label> 
        <input class="clase-cajatexto"
            id="nombre"
            type="text" 
            name="nombre" 
            value="{{old('nombre', $familia->nombre)}}">     
    </div>
 
     

<button class="btn btn-primary btn-lg btn-block"
    type="submit" 
    >{{$btnText}}
</button>
<a class="btn btn-link btn-block"
    href="{{ route('familias.index') }}"
    >Cancelar   
</a>