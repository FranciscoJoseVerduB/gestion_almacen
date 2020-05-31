
@if(empty($permisos))
<div class="d-flex justify-content-between align-items-center mb-3"> 
      <div class="d-flex align-items-baseline">
            <a class="btn btn-primary "
                href="{{route($ruta.'.create')}}"
            >{{$texto}}
            </a>
    </div> 
</div>
@else 
    @can($permisos, $objeto)
        <div class="d-flex justify-content-between align-items-center mb-3"> 
            <div class="d-flex align-items-baseline">
                <a class="btn btn-primary "
                    href="{{route($ruta.'.create')}}"
                >{{$texto}}
                </a>
            </div> 
        </div> 
    @endcan
@endif