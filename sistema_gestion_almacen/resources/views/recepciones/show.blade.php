@extends('layouts.principal') 

@section('title', 'Recepción | ' . $recepcion->serie . '/' . $recepcion->numero)

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
            'Usuario',
            'Creado'
            ],
        'filas'=> [
                $recepcion->serie,
                $recepcion->numero,
                $recepcion->fecha,
                $recepcion->proveedor->sujeto->nombre,
                $recepcion->almacen->sujeto->nombre, 
                $recepcion->user->nombre,
                $recepcion->created_at->diffForHumans()      
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
                </tr>
                </thead>
                <tbody> 
                    @foreach($recepcion->lineas as $linea) 
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
                            
                        </tr>
                    @endforeach
                </tbody>
            </table> 
        </div> <!-- FIN TABLA -->

  
        <div class="form-group  mr-auto">
            <label for="observaciones"> Observaciones </label> 
    
            <textarea class="clase-cajatexto" 
                    readonly
                    name="observaciones" 
                    id="observaciones">
                      {{$recepcion->observaciones}}
                </textarea>  
        </div>


            @include('partials._show-operations', [
                        'ruta' => 'recepciones',
                        'objeto'=> $recepcion,
                        'permisos' => 'modificarPanelRecepciones'    
                    ])  
        
              
        </div>
    </div> 
@endsection
