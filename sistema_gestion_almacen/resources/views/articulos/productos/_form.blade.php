

    
    @csrf
    <div class="form-group">
        <label for="codigo"> Código del producto </label> 
        <input class="clase-cajatexto"
            id="codigo"
            type="text" 
            name="codigo" 
            value="{{old('codigo', $producto->codigo)}}">     
    </div>

    <div class="form-group">
        <label for="nombre"> Nombre del producto </label> 
        <input class="clase-cajatexto"
            id="nombre"
            type="text" 
            name="nombre" 
            value="{{old('nombre', $producto->nombre)}}">     
    </div>

    <div class="form-group">
        <label for="precio"> Precio del producto </label> 
        <input class="clase-cajatexto"
            id="precio"
            type="text" 
            name="precio" 
            value="{{old('precio', $producto->precio)}}">     
    </div>

    <div class="form-group">
        <label for="subfamilia_id"> Subfamilia del producto </label> 
        <select class="clase-cajatexto"
            id="subfamilia_id" 
            name="subfamilia_id" > 
            
            @foreach ($subfamilias as $subfamilia)
                <option 
                    value="{{$subfamilia->id}}"
                    {{setSelectedCombobox(old('subfamilia_id', $producto->subfamilia_id), $subfamilia->id)}}
                    > {{$subfamilia->codigo . ' -- ' . $subfamilia->nombre}}
                </option>  
            @endforeach 
        </select>  
    </div>

    <div class="form-group">
        <label for="marca_id"> Marca del producto </label> 
        <select class="clase-cajatexto"
            id="marca_id" 
            name="marca_id" > 
            
            @foreach ($marcas as $marca)
                <option 
                    value="{{$marca->id}}"
                    {{setSelectedCombobox(old('marca_id', $producto->marca_id), $marca->id)}}
                    > {{$marca->codigo . ' -- ' . $marca->nombre}}
                </option>  
            @endforeach 
        </select>  
    </div>

   
    <div class="form-group">
        <label for="impuesto_id"> Impuesto del producto </label> 
        <select class="clase-cajatexto"
            id="impuesto_id" 
            name="impuesto_id" > 
            
            @foreach ($impuestos as $impuesto)
                <option 
                    value="{{$impuesto->id}}"
                    {{setSelectedCombobox(old('impuesto_id', $producto->impuesto_id), $impuesto->id)}}
                    > {{$impuesto->codigo . ' -- ' . $impuesto->nombre . '. IVA: '. $impuesto->porcentaje.'%'}}
                </option>  
            @endforeach 
        </select>  
    </div>

     

<button class="btn btn-primary btn-lg btn-block"
    type="submit" 
    >{{$btnText}}
</button>
<a class="btn btn-link btn-block"
    href="{{ route('productos.index') }}"
    >Cancelar   
</a>