

<div class="dropdown-divider"></div>

<div class="d-flex justify-content-between">  

    <div class="btn-group btn-group-sm shadow">
        <a class="btn btn-dark"
            href="{{ route($ruta.'.index') }}"
            >Regresar   
        </a>
    </div>
 
    @if(empty($permisos))
        <div class="btn-group btn-group-sm shadow">
            <a class="btn btn-primary mr-2"
                href="{{route($ruta.'.edit', $objeto)}}"
                >Editar </a>
            <a class="btn btn-danger"
                href="#" 
                onclick="getElementById('delete-item').submit()"
                >Eliminar
            </a> 
        </div>
        <form class="d-none"
            id="delete-item"
            method="POST" 
            action="{{route($ruta.'.destroy', $objeto)}}">
            @csrf
            @method('DELETE') 
        </form>
    @else
        @can($permisos, $objeto)
            <div class="btn-group btn-group-sm shadow">
                <a class="btn btn-primary mr-2"
                    href="{{route($ruta.'.edit', $objeto)}}"
                    >Editar </a>
                <a class="btn btn-danger"
                    href="#" 
                    onclick="getElementById('delete-item').submit()"
                    >Eliminar
                </a> 
            </div>
            <form class="d-none"
                id="delete-item"
                method="POST" 
                action="{{route($ruta.'.destroy', $objeto)}}">
                @csrf
                @method('DELETE') 
            </form>         
        @endcan 
    @endif
</div> 
