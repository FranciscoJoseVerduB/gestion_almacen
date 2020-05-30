

<div class="dropdown-divider"></div>

<div class="d-flex justify-content-between">  

    <div class="btn-group btn-group-sm shadow">
        <a class="btn btn-dark"
            href="{{ route($ruta.'.index') }}"
            >Regresar   
        </a>
    </div>

    @auth 
    
    @endauth
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
</div> 
