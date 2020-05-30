 
           
             
        @forelse($lineas as $linea) 
        <tr > 
            <td> <!-- Producto -->
                <select class="clase-cajatexto buscarPrecioProducto"
                    {{$linea->estado->estado != 'Pendiente'? 'Disabled': ''}}
                    id="lineas[{{$loop->index}}][producto_id]" 
                    name="lineas[{{$loop->index}}][producto_id]" >  

                    @foreach ($productos as $producto)
                        
                        <option 
                            value="{{$producto->id}}"
                            {{setSelectedCombobox(old('lineas.'.$loop->parent->index.'.producto_id', $linea->producto_id), $producto->id)}}
                            >{{$producto->codigo . ' -- ' . $producto->nombre}} 
                        </option>  
                    @endforeach 
                </select>   
             </td>  
             <td> <!-- Cantidad -->
                <input class="clase-cajatexto calcularImporteLineaPedido"
                        {{$linea->estado->estado != 'Pendiente'? 'readonly': ''}}
                        id="lineas[{{$loop->index}}][cantidad]"
                        type="number" 
                        name="lineas[{{$loop->index}}][cantidad]" 
                        value="{{old('lineas.'.$loop->index.'.cantidad', $linea->cantidad? $linea->cantidad: 0)}}"> 
             </td> 
             <td> <!-- Precio -->
                <input class="clase-cajatexto calcularImporteLineaPedido" 
                        {{$linea->estado->estado != 'Pendiente'? 'readonly': ''}}
                        step= "0.01"
                        id="lineas[{{$loop->index}}][precio]"
                        type="number" 
                        name="lineas[{{$loop->index}}][precio]" 
                        value="{{old('lineas.'.$loop->index.'.precio', $linea->precio? $linea->precio: 0)}}"> 
             </td>
             <td> <!-- Importe -->
                <input class="clase-cajatexto"  
                        readonly
                        id="lineas[{{$loop->index}}][importe]"
                        type="number" 
                        name="lineas[{{$loop->index}}][importe]" 
                        value="{{old('lineas.'.$loop->index.'.importe', $linea->importe? $linea->importe: 0)}}"> 
             </td>
             <td>
                <select class="clase-cajatexto"
                        {{ $linea->estado->estado != 'Pendiente'? 'Disabled': ''}}
                        id="lineas[{{$loop->index}}][lineaPedidoEstado_id]" 
                        name="lineas[{{$loop->index}}][lineaPedidoEstado_id]" > 
                    
                    @foreach ($linea_estados as $estado)
                        <option 
                            value="{{$estado->id}}"
                            {{setSelectedCombobox(old('lineas.'.$loop->parent->index.'.lineaPedidoEstado_id', $linea->lineaPedidoEstado_id), $estado->id)}}
                            > {{$estado->estado }}
                        </option>  
                    @endforeach 
                </select>  
            </td>
            @if($linea->estado->estado === 'Pendiente')
                <td> 
                    <input class="btn btn-danger btn-sm btn-block eliminarLineaPedido"   
                            type="button"
                            value="Eliminar"> 
                </td>
            @endif
            <td> <!-- ID de la Linea del Pedido -->
                <input class="clase-cajatexto clase-id"  
                        readonly
                        hidden
                        id="lineas[{{$loop->index}}][id]"
                        type="number" 
                        name="lineas[{{$loop->index}}][id]" 
                        value="{{old('lineas.'.$loop->index.'.id', $linea->id? $linea->id: 0)}}"> 
             </td>
         </tr> 
      
          @empty
            <tr> 
               <td class="text-center"
                 colspan="7"
                >No hay datos que mostrar
              </td> 
            </tr>
         @endforelse
   
