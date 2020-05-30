

    
    @csrf
    <div class="form-group">
        <label for="codigo"> Código de la subfamilia </label> 
        <input class="clase-cajatexto"
            id="codigo"
            type="text" 
            name="codigo" 
            value="{{old('codigo', $subfamilia->codigo)}}">     
    </div>

    <div class="form-group">
        <label for="nombre"> Nombre de la subfamilia </label> 
        <input class="clase-cajatexto"
            id="nombre"
            type="text" 
            name="nombre" 
            value="{{old('nombre', $subfamilia->nombre)}}">     
    </div>
 
    <div class="form-group">
        <label for="marca_id"> Familia de la subfamilia </label> 
        <select class="clase-cajatexto"
            id="marca_id" 
            name="marca_id" > 
            
            @foreach ($familias as $familia)
                <option 
                    value="{{$familia->id}}"
                    {{setSelectedCombobox(old('familia_id', $familia->id), $familia->id)}}
                    > {{$familia->codigo . ' -- ' . $familia->nombre}}
                </option>  
            @endforeach 
        </select>  
    </div>
    

<button class="btn btn-primary btn-lg btn-block"
    type="submit" 
    >{{$btnText}}
</button>
<a class="btn btn-link btn-block"
    href="{{ route('subfamilias.index') }}"
    >Cancelar   
</a>