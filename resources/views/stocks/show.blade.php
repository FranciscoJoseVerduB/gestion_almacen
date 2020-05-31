@extends('layouts.principal') 

@section('title', 'Stock | ' . $stock->almacen->sujeto->nombre . '/' . $stock->producto->codigo)

@section('content')
    <div class="container">
        <div class="bg-white p-5 shadow rounded sm-show"> 
 
    
<!-- Datos principales -->

    <div class="form-row"> 
        <div class="form-group  mr-auto">
            <label for="almacen_id"> Almacen </label> 
            <select class="clase-cajatexto"
                required
                id="almacen_id" 
                name="almacen_id" > 
                    <option 
                        value="{{$stock->almacen->id}}" 
                        > {{$stock->almacen->codigo . ' -- ' . $stock->almacen->sujeto->nombre }}
                    </option>  
            </select>  
        </div>
        <div class="form-group mr-auto ">
            <label for="producto_id"> Producto </label> 
            <select class="clase-cajatexto  actualizarListaPedidos-modal" 
                required
                id="producto_id" 
                name="producto_id" >    
                    <option 
                        value="{{$stock->producto_id}}"                   
                        > {{$stock->producto->codigo . ' -- ' . $stock->producto->nombre }}
                    </option>   
            </select>  
        </div>
    </div> 
        
        <hr>




 
<!-- Otra información -->
        
        <div class="table-responsive container">  
            <table  class="table table-sm table-striped table-bordered table-hover shadow">
                <thead  class="bg-info text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Codigo</th> 
                    <th scope="col">Movimiento</th> 
                    <th scope="col">Cantidad</th>  
                    <th scope="col">Documento</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Proveedor</th>

                </tr>
                </thead>
                <tbody> 
                    @foreach($stock->movimientos as $movimiento) 
                        <tr>
                            <th scope="row">
                                {{$loop->index +1}}
                            </th> 
                            <td>
                                {{$movimiento->tipoMovimientoAlmacen->codigo}}
                            </td>   
                            <td>
                                {{$movimiento->tipoMovimientoAlmacen->nombre}}
                            </td>   
                            <td>
                                @if($movimiento->recepcionLinea)
                                    {{$movimiento->recepcionLinea->cantidad}}
                                @elseif($movimiento->regularizacionLinea)
                                    {{$movimiento->regularizacionLinea->cantidad}}
                                @elseif($movimiento->pedidoLinea)
                                    {{$movimiento->pedidoLinea->cantidad}}
                                @endif 
                            </td> 
                            <td>
                                @if($movimiento->recepcionLinea)
                                    {{$movimiento->recepcionLinea->recepcion->serie .'/'.$movimiento->recepcionLinea->recepcion->numero}}
                                @elseif($movimiento->regularizacionLinea)
                                    {{$movimiento->regularizacionLinea->regularizacionManual->serie .'/'.$movimiento->regularizacionLinea->regularizacionManual->numero}}
                                @elseif($movimiento->pedidoLinea)
                                    {{$movimiento->pedidoLinea->pedido->serie .'/'.$movimiento->pedidoLinea->pedido->numero}}
                                @endif    
                            </td> 
                            <td>
                                @if($movimiento->recepcionLinea)
                                    {{$movimiento->recepcionLinea->recepcion->fecha}}
                                @elseif($movimiento->regularizacionLinea)
                                    {{$movimiento->regularizacionLinea->regularizacionManual->fecha}}
                                @elseif($movimiento->pedidoLinea)
                                    {{$movimiento->pedidoLinea->pedido->fecha}}
                                @endif 
                            </td>  
                            <td>
                                @if($movimiento->recepcionLinea)
                                    {{$movimiento->recepcionLinea->recepcion->proveedor->sujeto->nombre}}
                                @elseif($movimiento->regularizacionLinea)
                                    {{''}}
                                @elseif($movimiento->pedidoLinea)
                                    {{$movimiento->pedidoLinea->pedido->proveedor->sujeto->nombre}}
                                @endif  
                            </td> 
                            
                        </tr>
                    @endforeach
                </tbody>
            </table> 
        </div> <!-- FIN TABLA -->
 
        <div class="btn-group btn-group-sm shadow">
            <a class="btn btn-dark"
                href="{{ route('stocks.index') }}"
                >Regresar   
            </a>
        </div> 
        </div>
    </div> 
@endsection
