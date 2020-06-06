@extends('layouts.documentos')


@section('cabecera') 
  
<div class=" justify-content-between border border-primary "> 
      <h3 class=" text-center bg-cover">Documento de Recepción</h3>

    <div class="row ml-1 mr-1">
      <div class="col-6  float-left "> 
          <div class="card-body mr-1">
              <h5 class="card-title">Almacen</h5>
              <p class= "cabecera ">Código: {{$recepcion->almacen->codigo}}</p> 
              <p class="cabecera">Nombre: {{$recepcion->almacen->sujeto->nombre.' '. 
                                              $recepcion->almacen->sujeto->primerApellido. ' '. 
                                                 $recepcion->almacen->sujeto->segundoApellido}}</p>
              <p class="cabecera">NIF: {{$recepcion->almacen->sujeto->nif}}</p>
              <p class="cabecera">Email: {{$recepcion->almacen->sujeto->email}}</p>
              <p class="cabecera">Teléfono: {{$recepcion->almacen->sujeto->telefono}}</p>
              <p class="cabecera">Persona Contacto: {{$recepcion->almacen->sujeto->personaContacto}}</p>
              <p class="cabecera">Dirección: {{$recepcion->almacen->sujeto->direccion->direccion}}</p>
              <p class="cabecera">CP: {{$recepcion->almacen->sujeto->direccion->codigoPostal}}</p>
              <p class="cabecera">Población: {{$recepcion->almacen->sujeto->direccion->poblacion}}</p>
              <p class="cabecera">Provincia: {{$recepcion->almacen->sujeto->direccion->provincia}}</p>
              <p class="cabecera">País: {{$recepcion->almacen->sujeto->direccion->pais}}</p> 
          </div>  
      </div>

      <div class="col-6  float-right  ">
        <div class="card-body ml-1">
          <h5 class="card-title">Proveedor</h5>
          <p class= "cabecera ">Código: {{$recepcion->proveedor->codigo}}</p> 
          <p class="cabecera">Nombre: {{$recepcion->proveedor->sujeto->nombre.' '. 
                                          $recepcion->proveedor->sujeto->primerApellido. ' '. 
                                             $recepcion->proveedor->sujeto->segundoApellido}}</p>
          <p class="cabecera">NIF: {{$recepcion->proveedor->sujeto->nif}}</p>
          <p class="cabecera">Email: {{$recepcion->proveedor->sujeto->email}}</p>
          <p class="cabecera">Teléfono: {{$recepcion->proveedor->sujeto->telefono}}</p>
          <p class="cabecera">Persona Contacto: {{$recepcion->proveedor->sujeto->personaContacto}}</p>
          <p class="cabecera">Dirección: {{$recepcion->proveedor->sujeto->direccion->direccion}}</p>
          <p class="cabecera">CP: {{$recepcion->proveedor->sujeto->direccion->codigoPostal}}</p>
          <p class="cabecera">Población: {{$recepcion->proveedor->sujeto->direccion->poblacion}}</p>
          <p class="cabecera">Provincia: {{$recepcion->proveedor->sujeto->direccion->provincia}}</p>
          <p class="cabecera">País: {{$recepcion->proveedor->sujeto->direccion->pais}}</p>
        </div>
      </div>
    </div> 

    <div class="w-100"></div>

      <div class="col  ">
        <div class="card-body">
          <h5 class="card-title ">Observaciones</h5>
          <textarea >{{$recepcion->observaciones}}</textarea> 
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



@endsection 