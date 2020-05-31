@extends('layouts.principal') 

@section('title', 'Regularizacion | ' . $regularizacion_manual->serie . '/' . $regularizacion_manual->numero)

@section('content')
    <div class="container-fluid">
        <div class="bg-white p-5 shadow rounded sm-show"> 
  
<!-- Datos principales -->

    @include('partials._show-table', [
        'columnas' => [
            'Serie',
            'Numero', 
            'Fecha',  
            'Almacen',  
            'Usuario',
            'Creado'
            ],
        'filas'=> [
                $regularizacion_manual->serie,
                $regularizacion_manual->numero,
                $regularizacion_manual->fecha, 
                $regularizacion_manual->almacen->sujeto->nombre, 
                $regularizacion_manual->user->nombre,
                $regularizacion_manual->created_at->diffForHumans()      
            ]
    ])  
            
<!-- Otra información -->
        
        <div class="table-responsive container">  
            <table  class="table table-sm table-striped table-bordered table-hover shadow">
                <thead  class="bg-info text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>  
                    <th scope="col">Codigo</th>    
                    <th scope="col">Movimiento</th>    
                </tr>
                </thead>
                <tbody> 
                    @foreach($regularizacion_manual->lineas as $linea) 
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
                                {{$linea->movimiento->tipoMovimientoAlmacen->codigo}}
                            </td>                          
                            <td>
                                {{$linea->movimiento->tipoMovimientoAlmacen->nombre}}
                            </td>                          
                        </tr>
                    @endforeach
                </tbody>
            </table> 
        </div> <!-- FIN TABLA -->

  
            
            @include('partials._show-operations', [
                        'ruta' => 'regularizaciones_manual',
                        'objeto'=> $regularizacion_manual, 
                        'permisos' => 'modificarPanelStock'
                    ])  


        </div>
    </div> 
@endsection
