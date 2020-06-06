

    
    @csrf
    <div class="form-group">
        <label for="codigo"> Código del impuesto </label> 
        <input class="clase-cajatexto"
            id="codigo"
            type="text" 
            name="codigo" 
            value="{{old('codigo', $impuesto->codigo)}}">     
    </div>

    <div class="form-group">
        <label for="nombre"> Nombre del impuesto </label> 
        <input class="clase-cajatexto"
            id="nombre"
            type="text" 
            name="nombre" 
            value="{{old('nombre', $impuesto->nombre)}}">     
    </div>
 
     
    <div class="form-group">
        <label for="porcentaje"> Porcentaje del impuesto </label> 
        <input class="clase-cajatexto"
            id="porcentaje"
            type="text" 
            name="porcentaje" 
            value="{{old('porcentaje', $impuesto->porcentaje)}}">     
    </div>

<button class="btn btn-primary btn-lg btn-block"
    type="submit" 
    >{{$btnText}}
</button>
<a class="btn btn-link btn-block"
    href="{{ route('impuestos.index') }}"
    >Cancelar   
</a>