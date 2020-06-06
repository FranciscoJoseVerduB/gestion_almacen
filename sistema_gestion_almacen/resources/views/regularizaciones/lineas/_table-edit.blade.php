 
           
             
        @forelse($lineas as $linea) 
        <tr > 
            <td> <!-- Producto -->
                <select class="clase-cajatexto " 
                    id="lineas[{{$loop->index}}][producto_id] buscarStockProductoPorAlmacen" 
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
                <input class="clase-cajatexto buscarStockProductoPorAlmacen" 
                        id="lineas[{{$loop->index}}][cantidad]"
                        type="number" 
                        name="lineas[{{$loop->index}}][cantidad]" 
                        value="{{old('lineas.'.$loop->index.'.cantidad', $linea->cantidad? $linea->cantidad: 0)}}"> 
             </td> 
             <td> <!-- Creado -->
                <input class="clase-cajatexto " 
                        id="lineas[{{$loop->index}}][created_at]"
                        type="text" 
                        name="lineas[{{$loop->index}}][created_at]" 
                        value="{{old('lineas.'.$loop->index.'.created_at', $linea->created_at->diffForHumans() ? $linea->created_at->diffForHumans(): '')}}"> 
             </td>
              
             
             @if(!$linea->id)
            <td> 
                <input class="btn btn-danger btn-sm btn-block eliminarLineaRegularizacionManual"   
                        type="button"
                        value="Eliminar"> 
            </td>
            @endif
            <td> <!-- ID de la Linea del documento de Regularizacion Manual -->
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
   
