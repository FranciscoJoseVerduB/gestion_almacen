@extends('layouts.documentos')


@section('cabecera') 
   
<div class=" justify-content-between border border-primary "> 
      <h3 class=" text-center bg-cover">Regularización Manual</h3>

    <div class="row ml-1 mr-1">
      <div class="col-12  float-left "> 
          <div class="card-body mr-1">
              <h5 class="card-title">Almacen</h5>
              <p class= "cabecera ">Código: {{$regularizacion_manual->almacen->codigo}}</p> 
              <p class="cabecera">Nombre: {{$regularizacion_manual->almacen->sujeto->nombre.' '. 
                                              $regularizacion_manual->almacen->sujeto->primerApellido. ' '. 
                                                 $regularizacion_manual->almacen->sujeto->segundoApellido}}</p>
              <p class="cabecera">NIF: {{$regularizacion_manual->almacen->sujeto->nif}}</p>
              <p class="cabecera">Email: {{$regularizacion_manual->almacen->sujeto->email}}</p>
              <p class="cabecera">Teléfono: {{$regularizacion_manual->almacen->sujeto->telefono}}</p>
              <p class="cabecera">Persona Contacto: {{$regularizacion_manual->almacen->sujeto->personaContacto}}</p>
              <p class="cabecera">Dirección: {{$regularizacion_manual->almacen->sujeto->direccion->direccion}}</p>
              <p class="cabecera">CP: {{$regularizacion_manual->almacen->sujeto->direccion->codigoPostal}}</p>
              <p class="cabecera">Población: {{$regularizacion_manual->almacen->sujeto->direccion->poblacion}}</p>
              <p class="cabecera">Provincia: {{$regularizacion_manual->almacen->sujeto->direccion->provincia}}</p>
              <p class="cabecera">País: {{$regularizacion_manual->almacen->sujeto->direccion->pais}}</p> 
          </div>  
      </div> 
    </div> 

    <div class="w-100"></div>

      <div class="col  ">
        <div class="card-body">
          <h5 class="card-title ">Observaciones</h5>
          <textarea >{{$regularizacion_manual->observaciones}}</textarea> 
        </div>
      </div>

</div>
 
 


@endsection 

@section('lineas')

<div class="table-responsive">  
  <table  class="table table-striped table-bordered ">
      <thead  class="bg-info text-white">
      <tr>
          <th scope="col">#</th>
          <th scope="col">Producto</th>
          <th scope="col">Cantidad</th>       
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
              </tr>
          @endforeach
      </tbody>
  </table> 
</div> <!-- FIN TABLA -->



@endsection 