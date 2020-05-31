 
    @csrf 

<div class="form-row"> 
    <div class="form-group   mr-auto">
        <label for="fecha"> Fecha </label> 
        <input class="clase-cajatexto"
            required
            id="fecha"
            type="date" 
            name="fecha" 
            value="{{old('fecha', $pedido_compra->fecha)}}">     
    </div>

    <div class="form-group   mr-auto">
        <label for="estadoPedido_id"> Estado </label> 
        <select class="clase-cajatexto"
            required
            id="estadoPedido_id" 
            name="estadoPedido_id" > 
            
            @foreach ($estados as $estado)
                <option 
                    value="{{$estado->id}}"
                    {{setSelectedCombobox(old('estadoPedido_id', $pedido_compra->estadoPedido_id), $estado->id)}}
                    > {{$estado->estado }}
                </option>  
            @endforeach 
        </select>  
    </div>
</div>
 
<div class="form-row">
    <div class="form-group  mr-auto">
        <label for="proveedor_id"> Proveedor </label> 
        <select class="clase-cajatexto"
            required
            id="proveedor_id" 
            name="proveedor_id" > 
            
            @foreach ($proveedores as $proveedor)
                <option 
                    value="{{$proveedor->id}}"
                    {{setSelectedCombobox(old('proveedor_id', $pedido_compra->proveedor_id), $proveedor->id)}}
                    > {{$proveedor->codigo . ' -- ' . $proveedor->sujeto->nombre }}
                </option>  
            @endforeach 
        </select>  
    </div>

 
    <div class="form-group  mr-auto">
        <label for="almacenDestinoCompra_id"> Almacen </label> 
        <select class="clase-cajatexto"
            required
            id="almacenDestinoCompra_id" 
            name="almacenDestinoCompra_id" > 
            
            @foreach ($almacenes as $almacen)
                <option 
                    value="{{$almacen->id}}"
                    {{setSelectedCombobox(old('almacenDestinoCompra_id', $pedido_compra->almacenDestinoCompra_id), $almacen->id)}}
                    > {{$almacen->codigo . ' -- ' . $almacen->sujeto->nombre }}
                </option>  
            @endforeach 
        </select>  
    </div>
</div>
    <div class="form-group  mr-auto">
        <label for="observaciones"> Observaciones </label> 

        <textarea class="clase-cajatexto" 
                name="observaciones" 
                id="observaciones"
                >{{old('observaciones', $pedido_compra->observaciones)}}
            </textarea>  
    </div>
    
 <hr>
  

 <div class="table-responsive">
    <div class="d-flex align-items-baseline float-right my-2"> 
        <input class="btn btn-primary btn-sm btn-block anadirLineaPedido"  
            type="button"     
            @if($pedido_compra->estado)
                     {{($pedido_compra->estado->estado === 'Servido' || 
                        $pedido_compra->estado->estado === 'Anulado')
                        ? 'Disabled'
                        : ''}}
            @endif
            value="Añadir linea"> 
    </div>

    <table  class="table table-sm table-striped table-bordered table-hover shadow">
        <thead  class="bg-info text-white">
          <tr> 
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>   
            <th scope="col">Precio</th>  
            <th scope="col">Importe</th>  
            <th scope="col">Estado</th>  
            <th class=" text-center" scope="col">Operación</th>
          </tr>
        </thead>
        <tbody> 

            @if($btnText ==='Editar')
                @include('pedidos.lineas._table-edit')  
            @endif

        </tbody>
    </table>

</div>

<hr>      
<button class="btn btn-primary btn-lg btn-block"  
        @if($pedido_compra->estado != null) 
               {{ ($pedido_compra->estado->estado === 'Servido' || 
                    $pedido_compra->estado->estado === 'Anulado')
                    ? 'Disabled'
                    : ''
                }}
        @endif
    type="submit" 
    >{{$btnText}}
</button>
<a class="btn btn-link btn-block"
    href="{{ route('pedidos_compra.index') }}"
    >Cancelar   
</a>