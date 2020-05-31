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
                    <a class="nav-link dropdown-toggle 
                            {{ setActive('productos.*') }}
                            {{ setActive('marcas.*') }}  
                            {{ setActive('impuestos.*') }}  
                            {{ setActive('familias.*') }}  
                            {{ setActive('subfamilias.*') }}   
                            {{ setActive('articulos') }}" 
                        href="#"
                        id="navbarDropdownArticulos" 
                        role="button" 
                        data-toggle="dropdown" 
                        aria-haspopup="true" 
                        aria-expanded="false">
                        @lang('Articulos')
                    </a> 
                    <div class="dropdown-menu  " aria-labelledby="navbarDropdownArticulos">
                            <a class="dropdown-item {{ setActive('impuestos.*') }}  " href="{{route('impuestos.index')}}">Impuestos<a>    
                            <a class="dropdown-item {{ setActive('familias.*') }}  " href="{{route('familias.index')}}">Familias</a>
                            <a class="dropdown-item {{ setActive('marcas.*') }}  " href="{{route('marcas.index')}}">Marcas</a>
                            <a class="dropdown-item {{ setActive('productos.*') }}  " href="{{route('productos.index')}}">Productos</a> 
                            <a class="dropdown-item {{ setActive('subfamilias.*') }}  " href="{{route('subfamilias.index')}}">Subfamilias</a>
                            
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('articulos')}}">Articulos</a>
                    </div>
                </li> 
            @endcan
  
            @can('verPanelUbicaciones', new App\Ubicacion)
                <li class="nav-item dropdown"> 
                    <a class="nav-link dropdown-toggle 
                            {{ setActive('almacenes.*') }}  
                            {{ setActive('proveedores.*') }}" 
                        href="#"
                        id="navbarDropdownUbicaciones" 
                        role="button" 
                        data-toggle="dropdown" 
                        aria-haspopup="true" 
                        aria-expanded="false">
                        @lang('Ubicaciones')
                    </a> 
                    <div class="dropdown-menu  " aria-labelledby="navbarDropdownUbicaciones">
                        @can('verPanelAlmacenes', new App\Almacen)
                            <a class="dropdown-item  {{ setActive('almacenes.*') }}  " href="{{route('almacenes.index')}}">@lang('Almacenes')<a>  
                        @endcan
                        @can('verPanelProveedores', new App\Proveedor)  
                            <a class="dropdown-item  {{ setActive('proveedores.*') }}  " href="{{route('proveedores.index')}}">@lang('Proveedores')</a>  
                        @endcan
                    </div>
                </li> 
            @endcan

            @can('verPanelProcesos', new App\Proceso)
            <li class="nav-item dropdown"> 
                <a class="nav-link dropdown-toggle 
                        {{ setActive('recepciones.*') }}  
                        {{ setActive('pedidos_compra.*') }}
                        {{ setActive('stocks.*') }}" 
                    href="#"
                    id="navbarDropdownProcesos" 
                    role="button" 
                    data-toggle="dropdown" 
                    aria-haspopup="true" 
                    aria-expanded="false"
                    >@lang('Procesos')
                </a> 
                <div class="dropdown-menu  " aria-labelledby="navbarDropdownProcesos">
                    @can('verPanelPedidos', new App\PedidoCompra )
                        <a class="dropdown-item {{ setActive('pedidos_compra.*') }}" href="{{route('pedidos_compra.index')}}">@lang('Pedidos')<a>  
                    @endcan  
                    @can('verPanelRecepciones', new App\Recepcion )
                        <a class="dropdown-item {{ setActive('recepciones.*') }}" href="{{route('recepciones.index')}}">@lang('Recepciones')</a>
                    @endcan
                    @can('verPanelStock', new App\Stock ) 
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ setActive('stocks.*') }}" href="{{route('stocks.index')}}">@lang('Stock')</a>  
                        <a class="dropdown-item {{ setActive('regularizaciones_manual.*') }}" href="{{route('regularizaciones_manual.index')}}">@lang('Regularizaciones Manuales')</a>  
                    @endcan
                </div>
            </li> 
        @endcan


         
            @can('verPanelUsuarios', new App\User) 
                <li class="nav-item dropdown"> 
                    <a class="nav-link dropdown-toggle 
                            {{ setActive('usuarios.*') }}  
                            {{ setActive('roles.*') }} "
                        href="#"
                        id="navbarDropdownProcesos" 
                        role="button" 
                        data-toggle="dropdown" 
                        aria-haspopup="true" 
                        aria-expanded="false">
                        @lang('Usuarios')
                    </a> 
                    <div class="dropdown-menu  " aria-labelledby="navbarDropdownProcesos"> 
                        <a class="dropdown-item {{ setActive('usuarios.*') }}  " href="{{route('usuarios.index')}}">@lang('Usuarios')<a>    
                        <a class="dropdown-item {{ setActive('roles.*') }}  " href="{{route('roles.index')}}">@lang('Roles')</a> 
                    </div>
                </li> 
            @endcan

            
            <li class="nav-item  "> 
                <a class="nav-link" 
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form> 
            </li> 
         </ul> 

         <form class="form-inline  my-2 my-lg-0">
            <input class="form-control mr-sm-1 ml-1" 
                    name="buscarpor" 
                    type="search" 
                    placeholder="Buscar" 
                    aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" 
                    hidden
                    type="submit">Buscar</button>
          </form>
    </div>

</nav>

<nav class="nav flex-column"
    aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home/</a></li>
        <?php $segments = ''; ?>
        @foreach(Request::segments() as $segment)
            <?php $segments .= '/'.$segment; ?>
            <li class="breadcrumb-item"><a href="{{ $segments }}">{{$segment}}</a>
            </li>
        @endforeach 
    </ol>
  </nav>

 
