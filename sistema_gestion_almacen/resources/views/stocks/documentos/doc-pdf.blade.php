@extends('layouts.documentos')

 
@section('cabecera') 
   
<div class=" justify-content-between border border-primary "> 
      <h3 class=" text-center bg-cover">Informe de Stock</h3> 
</div>
  
@endsection 

@section('lineas')

<div class="table-responsive">  
  <table  class="table table-striped table-bordered ">
      <thead  class="bg-info text-white">
      <tr>
          <th scope="col">#</th>
          <th scope="col">Almacen</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Poblacion</th>
          <th scope="col">Producto</th>
          <th scope="col">Cantidad</th>       
      </tr>
      </thead>
      <tbody> 
          @foreach($stocks as $stock) 
              <tr>
                  <th scope="row">
                      {{$loop->index +1}}
                  </th> 
                  <td>
                      {{$stock->almacen->sujeto->nombre.' '. 
                          $stock->almacen->sujeto->primerApellido. ' '. 
                            $stock->almacen->sujeto->segundoApellido}}
                  </td>
                  <td>
                      {{$stock->almacen->sujeto->telefono}}
                  </td> 
                  <td>
                      {{$stock->almacen->sujeto->direccion->poblacion}}
                  </td> 
                  <td>
                      {{$stock->producto->codigo . ' -- ' .$stock->producto->nombre}}
                  </td> 
                  <td>
                      {{$stock->cantidad}}
                  </td>  
              </tr>
          @endforeach
      </tbody>
  </table> 
</div> <!-- FIN TABLA -->



@endsection 