

    
    @csrf
    <div class="form-group">
        <label  for="codigo"> Código del usuario </label> 
        <input class="clase-cajatexto "
            id="codigo"
            type="text" 
            name="codigo" 
            value="{{old('codigo', $usuario->codigo)}}">     
    </div>

    <div class="form-group">
        <label for="nombre"> Nombre del usuario </label> 
        <input class="clase-cajatexto"
            id="nombre"
            type="text" 
            name="nombre" 
            value="{{old('nombre', $usuario->nombre)}}">     
    </div>

    
    @if($btnText !== "Editar")
    <div class="form-group">
        <label for="password"> Password del usuario </label> 
        <input class="  clase-cajatexto"
            id="password"
            type="password" 
            name="password" 
            value="{{old('password', $usuario->password)}}">     
    </div>
    @endif
 
    <div class="form-group">
        <label for="email"> Email del usuario </label> 
        <input class=" clase-cajatexto"
            id="email"
            type="text" 
            name="email" 
            value="{{old('email', $usuario->email)}}">     
    </div>

  
    
    <div class="form-group">
        <label for="telefono"> Teléfono del usuario </label> 
        <input class="clase-cajatexto"
            id="telefono"
            type="text" 
            name="telefono" 
            value="{{old('telefono', $usuario->telefono)}}">     
    </div>

 
  
    <div class="form-group">
        <label for="role_id"> Rol del producto </label> 
        <select class="clase-cajatexto"
            id="role_id" 
            name="role_id" > 
            
            @foreach ($roles as $rol)
                <option 
                    value="{{$rol->id}}"
                    {{setSelectedCombobox(old('role_id', $usuario->role_id), $rol->id)}}
                    > {{$rol->codigo . ' -- ' . $rol->nombre}}
                </option>  
            @endforeach 
        </select>  
    </div>
 
     

<button class="btn btn-primary btn-lg btn-block"
    type="submit" 
    >{{$btnText}}
</button>
<a class="btn btn-link btn-block btn-dark"
    href="{{ route('usuarios.index') }}"
    >Cancelar   
</a>