 
    @csrf 

<div class="form-row"> 
    <div class="form-group   mr-auto">
        <label for="fecha"> Fecha </label> 
        <input class="clase-cajatexto"
            required
            id="fecha"
            type="date" 
            name="fecha" 
            value="{{old('fecha', $recepcion->fecha)}}">     
    </div>
</div>
    
 
<div class="form-row">
    <div class="form-group mr-auto ">
        <label for="proveedor_id"> Proveedor </label> 
        <select class="clase-cajatexto  actualizarListaPedidos-modal" 
            required
            id="proveedor_id" 
            name="proveedor_id" > 
            
            @if($btnText ==='Guardar')
                @foreach ($proveedores as $proveedor)
                    <option 
                        value="{{$proveedor->id}}"
                        {{setSelectedCombobox(old('proveedor_id', $recepcion->proveedor_id), $proveedor->id)}}
                        > {{$proveedor->codigo . ' -- ' . $proveedor->sujeto->nombre }}
                    </option>  
                @endforeach 
            @else
                <option 
                    value="{{$recepcion->proveedor_id}}"                   
                    > {{$recepcion->proveedor->codigo . ' -- ' . $recepcion->proveedor->sujeto->nombre }}
                </option>  
            @endif
        </select>  
    </div>

 
    <div class="form-group  mr-auto">
        <label for="almacen_id"> Almacen </label> 
        <select class="clase-cajatexto"
            required
            id="almacen_id" 
            name="almacen_id" > 
            
            @if($btnText ==='Guardar')

                @foreach ($almacenes as $almacen)
                    <option 
                        value="{{$almacen->id}}"
                        {{setSelectedCombobox(old('almacen_id', $recepcion->almacen_id), $almacen->id)}}
                        > {{$almacen->codigo . ' -- ' . $almacen->sujeto->nombre }}
                    </option>  
                @endforeach 
            @else
                <option 
                    value="{{$recepcion->almacen->id}}" 
                    > {{$recepcion->almacen->codigo . ' -- ' . $recepcion->almacen->sujeto->nombre }}
                </option> 
            @endif
        </select>  
    </div>
</div>
    <div class="form-group  mr-auto">
        <label for="observaciones"> Observaciones </label> 

        <textarea class="clase-cajatexto" 
                name="observaciones" 
                id="observaciones">
                {{old('observaciones', $recepcion->observaciones)}}
            </textarea>  
    </div>
    
 <hr>
  

 <div class="table-responsive">
    <div class="d-flex align-items-baseline float-right my-2"> 
        <input class="btn btn-primary btn-sm btn-block anadirLineaRecepcion"  
            type="button"
            value="Añadir linea"> 
    </div>
    
    <div class="d-flex align-items-baseline float-right my-2 mr-4"> 
        <input class="btn btn-primary btn-sm btn-block rescatarLineaPedido-Recepcion"  
            data-toggle="modal"
            data-target="#exampleModal"
            type="button"
            value="Capturar linea pedido"> 
    </div>
    @include('recepciones.modals.listaPedidos')  

    <table  class="table table-sm table-striped table-bordered table-hover shadow">
        <thead  class="bg-info text-white">
          <tr> 
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>   
            <th class=" text-center" scope="col">Operación</th>
          </tr>
        </thead>
        <tbody> 

             
            @if($btnText ==='Editar')
                @include('recepciones.lineas._table-edit')  
            @endif

        </tbody>
    </table>

</div>

<hr> 
<button class="btn btn-primary btn-lg btn-block"
    type="submit" 
    >{{$btnText}}
</button>
<a class="btn btn-link btn-block"
    href="{{ route('recepciones.index') }}"
    >Cancelar   
</a>