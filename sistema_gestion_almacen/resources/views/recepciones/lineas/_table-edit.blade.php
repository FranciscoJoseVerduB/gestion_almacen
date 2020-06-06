 
           
             
        @forelse($lineas as $linea) 
        <tr> 
            <td> <!-- Producto -->
               
                <select class="clase-cajatexto" 
                    id="lineas[{{$loop->index}}][producto_id]" 
                    name="lineas[{{$loop->index}}][producto_id]" >  
                    
                    @if($linea->pedidoLineaPivot === null)
                        @foreach ($productos as $producto)
                            <option 
                                value="{{$producto->id}}"
                                {{setSelectedCombobox(old('lineas.'.$loop->parent->index.'.producto_id', $linea->producto_id), $producto->id)}}
                                >{{$producto->codigo . ' -- ' . $producto->nombre}} 
                            </option>  
                        @endforeach 
                    @else 
                        <option 
                            value="{{$linea->producto->id}}" 
                            >{{$linea->producto->codigo . ' -- ' . $linea->producto->nombre}} 
                        </option> 
                    @endif
                </select>
                
             </td>  
             <td> <!-- Cantidad -->
                <input class="clase-cajatexto "
                        id="lineas[{{$loop->index}}][cantidad]"
                        type="number" 
                        name="lineas[{{$loop->index}}][cantidad]" 
                        value="{{old('lineas.'.$loop->index.'.cantidad', $linea->cantidad? $linea->cantidad: 0)}}"> 
             </td> 
            
             
            <td> 
                <input class="btn btn-danger btn-sm btn-block eliminarLineaRecepcion"  
                        type="button"
                        value="Eliminar"> 
            </td>
            <td> <!-- ID de la Linea del Pedido -->
                <input class="clase-cajatexto clase-id"  
                        readonly
                        hidden
                        id="lineas[{{$loop->index}}][id]"
                        type="number" 
                        name="lineas[{{$loop->index}}][id]" 
                        value="{{old('lineas.'.$loop->index.'.id', $linea->id? $linea->id: 0)}}"> 
             </td> 

             @if($linea->pedidoLineaPivot !== null) 
            <td> <!-- ID de la linea del pedido de compra -->
                <input class="clase-cajatexto " 
                        required
                        hidden
                        id="lineas[{{$loop->index}}][pedidoCompraLinea_id]"
                        type="number" 
                        name="lineas[{{$loop->index}}][pedidoCompraLinea_id]" 
                        value="{{old('lineas.'.$loop->index.'.pedidoCompraLinea_id', $linea->pedidoLineaPivot? $linea->pedidoLineaPivot->pedidoCompraLinea_id: '0')}}"> 
            </td> 
            @endif
        </tr> 
      
          @empty
            <tr> 
               <td class="text-center"
                 colspan="7"
                >No hay datos que mostrar
              </td> 
            </tr>
         @endforelse
   
