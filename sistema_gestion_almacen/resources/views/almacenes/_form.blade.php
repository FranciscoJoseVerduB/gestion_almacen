

    
    @csrf 
    <div class="form-group">
        <label for="codigo"> Código del almacen </label> 
        <input class="clase-cajatexto"
            id="codigo"
            type="text" 
            name="codigo" 
            value="{{old('codigo', $almacen->codigo)}}">     
    </div>

    <div class="form-group">
        <label for="nombre">Razón Social/Nombre Persona Fisica </label> 
        <input class="clase-cajatexto"
            id="nombre"
            type="text" 
            name="nombre" 
            value="{{old('nombre', $sujeto->nombre)}}">     
    </div>
 
    <div class="form-group">
        <label for="primerApellido"> Primer Apellido de Persona Fisica </label> 
        <input class="clase-cajatexto"
            id="primerApellido"
            type="text" 
            name="primerApellido" 
            value="{{old('primerApellido', $sujeto->primerApellido)}}">     
    </div>
 
    <div class="form-group">
        <label for="segundoApellido"> Segundo Apellido de Persona Fisica </label> 
        <input class="clase-cajatexto"
            id="segundoApellido"
            type="text" 
            name="segundoApellido" 
            value="{{old('segundoApellido', $sujeto->segundoApellido)}}">     
    </div>
 
    
    <div class="form-group">
        <label for="nif"> NIF del almacen </label> 
        <input class="clase-cajatexto"
            id="nif"
            type="text" 
            name="nif" 
            value="{{old('nif', $sujeto->nif)}}">     
    </div>
 
    <div class="form-group">
        <label for="email"> Email del almacen </label> 
        <input class="clase-cajatexto"
            id="email"
            type="text" 
            name="email" 
            value="{{old('email', $sujeto->email)}}">     
    </div>
    <div class="form-group">
        <label for="telefono">Teléfono del almacen </label> 
        <input class="clase-cajatexto"
            id="telefono"
            type="text" 
            name="telefono" 
            value="{{old('telefono', $sujeto->telefono)}}">     
    </div>

    <div class="form-group">
        <label for="personaContacto">Persona de Contacto del almacen </label> 
        <input class="clase-cajatexto"
            id="personaContacto"
            type="text" 
            name="personaContacto" 
            value="{{old('personaContacto', $sujeto->personaContacto)}}">     
    </div>

      
    <div class="form-group">
        <label for="paginaWeb">Página Web del almacen </label> 
        <input class="clase-cajatexto"
            id="paginaWeb"
            type="text" 
            name="paginaWeb" 
            value="{{old('paginaWeb', $sujeto->paginaWeb)}}">     
    </div>
    <div class="form-group">
        <label for="direccion">Dirección del almacen </label> 
        <input class="clase-cajatexto"
            id="direccion"
            type="text" 
            name="direccion" 
            value="{{old('direccion', $direccion->direccion)}}">     
    </div> 

    <div class="form-group">
        <label for="codigoPostal">Código Postal del almacen </label> 
        <input class="clase-cajatexto"
            id="codigoPostal"
            type="text" 
            name="codigoPostal" 
            value="{{old('codigoPostal', $direccion->codigoPostal)}}">     
    </div> 

    <div class="form-group">
        <label for="poblacion">Población del almacen </label> 
        <input class="clase-cajatexto"
            id="poblacion"
            type="text" 
            name="poblacion" 
            value="{{old('poblacion', $direccion->poblacion)}}">     
    </div>  

    <div class="form-group">
        <label for="provincia">Provincia del almacen </label> 
        <input class="clase-cajatexto"
            id="provincia"
            type="text" 
            name="provincia" 
            value="{{old('provincia', $direccion->provincia)}}">     
    </div>  

    <div class="form-group">
        <label for="pais">País del almacen </label> 
        <input class="clase-cajatexto"
            id="pais"
            type="text" 
            name="pais" 
            value="{{old('pais', $direccion->pais)}}">     
    </div>  




     
<button class="btn btn-primary btn-lg btn-block"
    type="submit" 
    >{{$btnText}}
</button>
<a class="btn btn-link btn-block"
    href="{{ route('almacenes.index') }}"
    >Cancelar   
</a>