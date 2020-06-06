@extends('layouts.principal') 

@section('title', 'Pedido | ' . $pedido_compra->serie . '/' . $pedido_compra->numero)

@section('content')
    <div class="container-fluid">
        <div class="bg-white p-5 shadow rounded sm-show"> 
 
 
<!-- Datos principales -->

    @include('partials._show-table', [
        'columnas' => [
            'Serie',
            'Numero', 
            'Fecha', 
            'Proveedor', 
            'Almacen', 
            'Estado',
            'Usuario',
            'Creado'
            ],
        'filas'=> [
                $pedido_compra->serie,
                $pedido_compra->numero,
                $pedido_compra->fecha,
                $pedido_compra->proveedor->sujeto->nombre,
                $pedido_compra->almacen->sujeto->nombre,
                $pedido_compra->estado->estado,
                $pedido_compra->user->nombre,
                $pedido_compra->created_at->diffForHumans()      
            ]
    ])  

      
<div class="form-group  mr-auto">
    <label for="observaciones"> Observaciones </label> 

    <textarea class="clase-cajatexto" 
            readonly
            name="observaciones" 
            id="observaciones">
              {{$pedido_compra->observaciones}}
        </textarea>  
</div>
            
<!-- Otra información -->
        
        <div class="table-responsive container">  
            <table  class="table table-sm table-striped table-bordered table-hover shadow">
                <thead  class="bg-info text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>   
                    <th scope="col">Cant. Recibida</th>   
                    <th scope="col">Precio</th>  
                    <th scope="col">Importe</th>  
                    <th scope="col">Estado</th>   
                </tr>
                </thead>
                <tbody> 
                    @foreach($pedido_compra->lineas as $linea) 
                        <tr>
                            <th scope="row">
                                {{$loop->index +1}}
                            </th>
                            <td>
                                {{$linea->producto->codigo . ' -- ' .$linea->producto->nombre}}
                            </td> 
                            <td>
                                {{$linea->cantidad}}
                            </td>
                            <td>
                                {{$linea->cantidadRecibida}}
                            </td>
                            <td>
                                {{$linea->precio}}
                            </td>
                            <td>
                                {{$linea->importe}}
                            </td>
                            <td>
                                {{$linea->estado->estado}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
        </div> <!-- FIN TABLA -->

  
             
            @include('partials._show-operations', [
                            'ruta' => 'pedidos_compra',
                            'objeto'=> $pedido_compra, 
                            'permisos' => 'modificarPanelPedidos'
                        ])     
        
        </div>
    </div> 
@endsection
