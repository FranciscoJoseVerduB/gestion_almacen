

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
                    data-toggle="modal" 
                    data-target="#borrar-item-modal"
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
            
            
            <div class="modal fade" id="borrar-item-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <div class="modal-header">                            
                            <h5>Cuidado</h5> 
                            <button type="button" class="close justify-content-between" data-dismiss="modal">
                                <h6>×</h6>
                            </button> 
                        </div>
                        <div class="modal-body">
                           <h4>Va a borrar el registro seleccionado. ¿Continuar?</h4>
                        </div> 
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-success" data-dismiss="modal">
                                <span>Cancelar</span>
                            </button> 

                            <input  type="submit" 
                                    class="btn btn-danger"  
                                    onclick="getElementById('delete-item').submit()"
                                    value="Borrar">
                        </div>
                    </div>
                </div>
            </div>
        @endcan 
    @endif
</div> 
