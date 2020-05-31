<nav  
    class="navbar navbar-light navbar-expand-lg shadow-lg">

    <a class="navbar-brand" href="{{route('home')}}"> 
    
    <!--    {{config('app.name')}} -->
        <img 
            class="img-fluid " 
            height="auto"
            width="100px"
            src="/img/icono-gestionalo.png" 
            alt="Gestionalo"> 
    </a>  
    

    <button class="navbar-toggler" 
            type="button" 
            data-toggle="collapse" 
            data-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" 
            aria-expanded="false" 
            aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
 

    <div class="collapse navbar-collapse shadow-lg navbar-text text-danger" id="navbarSupportedContent">
        <ul class="nav nav-pills">    
            <li class="nav-item ml-sm-3" > 
                <a class="nav-link {{ setActive('home') }}" href="{{route('home')}}">
                    @lang('Home')
                </a>
            </li> 
            @can('verPanelProductos', new App\Producto)
                <li class="nav-item dropdown"> 
                    <a class="nav-link dropdown-toggle {{ setActive('productos.*') }}  {{ setActive('articulos') }}" 
                        href="#"
                        id="navbarDropdown" 
                        role="button" 
                        data-toggle="dropdown" 
                        aria-haspopup="true" 
                        aria-expanded="false">
                        @lang('Articulos')
                    </a> 
                    <div class="dropdown-menu  " aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('impuestos.index')}}">Impuestos<a>    
                            <a class="dropdown-item" href="{{route('familias.index')}}">Familias</a>
                            <a class="dropdown-item" href="{{route('marcas.index')}}">Marcas</a>
                            <a class="dropdown-item" href="{{route('productos.index')}}">Productos</a> 
                            <a class="dropdown-item" href="{{route('subfamilias.index')}}">Subfamilias</a>
                            
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('articulos')}}">Articulos</a>
                    </div>
                </li> 
            @endcan
            @can('verPanelPedidos', new App\PedidoCompra )
                <li class="nav-item  ">
                    <a class="nav-link {{ setActive('pedidos_compra.*') }}" href="{{route('pedidos_compra.index')}}">
                        @lang('Pedidos')
                    </a>
                </li> 
            @endcan
            @can('verPanelRecepciones', new App\Recepcion  )
                <li class="nav-item  ">
                    <a class="nav-link {{ setActive('recepciones.*') }}" href="{{route('recepciones.index')}}">
                        @lang('Recepciones')
                    </a>
                </li> 
            @endcan
            
            @can('verPanelProveedores', new App\Proveedor)
                <li class="nav-item  ">
                    <a class="nav-link {{ setActive('proveedores.*') }}" href="{{route('proveedores.index')}}">
                        @lang('Proveedores')
                    </a>
                </li> 
            @endcan

            @can('verPanelAlmacenes', new App\Almacen)
                <li class="nav-item  ">
                    <a class="nav-link {{ setActive('almacenes.*') }}" href="{{route('almacenes.index')}}">
                        @lang('Almacenes')
                    </a>
                </li> 
            @endcan

            @can('verPanelStock', new App\Stock )
                <li class="nav-item  ">
                    <a class="nav-link {{ setActive('stocks.*') }}" href="{{route('stocks.index')}}">
                        @lang('Stock')
                    </a>
                </li> 
            @endcan

            @can('verPanelUsuarios', new App\User)
                <li class="nav-item  ">
                    <a class="nav-link {{ setActive('usuarios.*') }}  {{ setActive('roles.*') }}" href="{{route('usuarios.index')}}">
                        @lang('Usuarios')
                    </a>
                </li>  
            @endcan
         </ul> 
         <form class="form-inline  my-2 my-lg-0">
            <input class="form-control mr-sm-1" 
                    name="buscarpor" 
                    type="search" 
                    placeholder="Buscar" 
                    aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
          </form>
    </div>

</nav>




