

    
    @csrf


    <div class="form-group">
        <label for="codigo"> Código del rol </label> 
        <input class="clase-cajatexto"
            id="codigo"
            type="text" 
            name="codigo" 
            value="{{old('codigo', $rol->codigo)}}">     
    </div>

    <div class="form-group">
        <label for="nombre"> Nombre del rol </label> 
        <input class="clase-cajatexto"
            id="nombre"
            type="text" 
            name="nombre" 
            value="{{old('nombre', $rol->nombre)}}">     
    </div>

    
    
    <div class="form-group">
        <label for="permisoAdministrador"> Permisos Administrador </label> 
        <input class="clase-cajatexto"
            id="permisoAdministrador"
            type="checkbox" 
            name="permisoAdministrador" 
            {{old('permisoAdministrador', $permisosRol->permisoAdministrador)?'checked': ''}}>     
    </div>
    <div class="form-group">
        <label for="verPanelRecursos"> Ver Panel Recursos </label> 
        <input class="clase-cajatexto"
            id="verPanelRecursos"
            type="checkbox" 
            name="verPanelRecursos" 
            {{old('verPanelRecursos', $permisosRol->verPanelRecursos)?'checked': ''}}>     
    </div>
    
    <!-- Productos -->
    <div class="form-group">
        <label for="verPanelProductos"> Ver Panel Productos</label> 
        <input class="clase-cajatexto"
            id="verPanelProductos"
            type="checkbox" 
            name="verPanelProductos" 
            {{old('verPanelProductos', $permisosRol->verPanelProductos)?'checked': ''}}>     
    </div> 
    <div class="form-group">
        <label for="modificarPanelProductos"> Modificar Panel Productos</label> 
        <input class="clase-cajatexto"
            id="modificarPanelProductos"
            type="checkbox" 
            name="modificarPanelProductos" 
            {{old('modificarPanelProductos', $permisosRol->modificarPanelProductos)?'checked': ''}}>     
    </div>
        
    
<!-- Usuarios -->        
    <div class="form-group">
        <label for="verPanelUsuarios"> Ver Panel Usuarios </label> 
        <input class="clase-cajatexto"
            id="verPanelUsuarios"
            type="checkbox" 
            name="verPanelUsuarios" 
            {{old('verPanelUsuarios', $permisosRol->verPanelUsuarios)?'checked': ''}}>     
    </div> 
    <div class="form-group">
        <label for="modificarPanelUsuarios"> Modificar Panel Usuarios </label> 
        <input class="clase-cajatexto"
            id="modificarPanelUsuarios"
            type="checkbox" 
            name="modificarPanelUsuarios" 
            {{old('modificarPanelUsuarios', $permisosRol->modificarPanelUsuarios)?'checked': ''}}>     
    </div>

    <!-- Pedidos -->   
    <div class="form-group">
        <label for="verPanelPedidos"> Ver Panel Pedidos</label> 
        <input class="clase-cajatexto"
            id="verPanelPedidos"
            type="checkbox" 
            name="verPanelPedidos" 
            {{old('verPanelPedidos', $permisosRol->verPanelPedidos)?'checked': ''}}>     
    </div>
    <div class="form-group">
        <label for="modificarPanelPedidos"> Modificar Panel Pedidos</label> 
        <input class="clase-cajatexto"
            id="modificarPanelPedidos"
            type="checkbox" 
            name="modificarPanelPedidos" 
            {{old('modificarPanelPedidos', $permisosRol->modificarPanelPedidos)?'checked': ''}}>     
    </div>


    <!-- Recepciones -->      
    <div class="form-group">
        <label for="verPanelRecepciones"> Ver Panel Recepciones</label> 
        <input class="clase-cajatexto"
            id="verPanelRecepciones"
            type="checkbox" 
            name="verPanelRecepciones" 
            {{old('verPanelRecepciones', $permisosRol->verPanelRecepciones)?'checked': ''}}>     
    </div>      
    <div class="form-group">
        <label for="modificarPanelRecepciones"> Modificar Panel Recepciones</label> 
        <input class="clase-cajatexto"
            id="modificarPanelRecepciones"
            type="checkbox" 
            name="modificarPanelRecepciones" 
            {{old('modificarPanelRecepciones', $permisosRol->modificarPanelRecepciones)?'checked': ''}}>     
    </div>
            
    <!-- Stock -->
    <div class="form-group">
        <label for="verPanelStock"> Ver Panel Stock</label> 
        <input class="clase-cajatexto"
            id="verPanelStock"
            type="checkbox" 
            name="verPanelStock" 
            {{old('verPanelStock', $permisosRol->verPanelStock)?'checked': ''}}>     
    </div>
    <div class="form-group">
        <label for="modificarPanelStock"> Modificar Panel Stock</label> 
        <input class="clase-cajatexto"
            id="modificarPanelStock" 
            type="checkbox" 
            name="modificarPanelStock" 
            {{old('modificarPanelStock', $permisosRol->modificarPanelStock)?'checked': ''}}>     
    </div>
    
    <!-- Almacenes -->
    <div class="form-group">
        <label for="verPanelAlmacenes"> Ver Panel Almacenes</label> 
        <input class="clase-cajatexto"
            id="verPanelAlmacenes"
            type="checkbox" 
            name="verPanelAlmacenes" 
            {{old('verPanelAlmacenes', $permisosRol->verPanelAlmacenes)?'checked': ''}}>     
    </div>
    <div class="form-group">
        <label for="modificarPanelAlmacenes"> Modificar Panel Almacenes</label> 
        <input class="clase-cajatexto"
            id="modificarPanelAlmacenes"
            type="checkbox" 
            name="modificarPanelAlmacenes" 
            {{old('modificarPanelAlmacenes', $permisosRol->modificarPanelAlmacenes)?'checked': ''}}>     
    </div>
  
    <!-- Proveedores -->
    <div class="form-group">
        <label for="verPanelProveedores"> Ver Panel Proveedores</label> 
        <input class="clase-cajatexto"
            id="verPanelProveedores"
            type="checkbox" 
            name="verPanelProveedores" 
            {{old('verPanelProveedores', $permisosRol->verPanelProveedores)?'checked': ''}}>     
    </div>
    <div class="form-group">
        <label for="modificarPanelProveedores"> Ver Panel Proveedores</label> 
        <input class="clase-cajatexto"
            id="modificarPanelProveedores"
            type="checkbox" 
            name="modificarPanelProveedores" 
            {{old('modificarPanelProveedores', $permisosRol->modificarPanelProveedores)?'checked': ''}}>     
    </div>
     

<button class="btn btn-primary btn-lg btn-block"
    type="submit" 
    >{{$btnText}}
</button>
<a class="btn btn-link btn-block"
    href="{{ route('roles.index') }}"
    >Cancelar   
</a>