@extends('layouts.documentos')


@section('cabecera') 
  
<div class=" justify-content-between border border-primary "> 
      <h3 class=" text-center bg-cover">Pedido de Compra</h3>

    <div class="row ml-1 mr-1">
      <div class="col-6  float-left "> 
          <div class="card-body mr-1">
              <h5 class="card-title">Almacen</h5>
              <p class= "cabecera ">Código: {{$pedido_compra->almacen->codigo}}</p> 
              <p class="cabecera">Nombre: {{$pedido_compra->almacen->sujeto->nombre.' '. 
                                              $pedido_compra->almacen->sujeto->primerApellido. ' '. 
                                                 $pedido_compra->almacen->sujeto->segundoApellido}}</p>
              <p class="cabecera">NIF: {{$pedido_compra->almacen->sujeto->nif}}</p>
              <p class="cabecera">Email: {{$pedido_compra->almacen->sujeto->email}}</p>
              <p class="cabecera">Teléfono: {{$pedido_compra->almacen->sujeto->telefono}}</p>
              <p class="cabecera">Persona Contacto: {{$pedido_compra->almacen->sujeto->personaContacto}}</p>
              <p class="cabecera">Dirección: {{$pedido_compra->almacen->sujeto->direccion->direccion}}</p>
              <p class="cabecera">CP: {{$pedido_compra->almacen->sujeto->direccion->codigoPostal}}</p>
              <p class="cabecera">Población: {{$pedido_compra->almacen->sujeto->direccion->poblacion}}</p>
              <p class="cabecera">Provincia: {{$pedido_compra->almacen->sujeto->direccion->provincia}}</p>
              <p class="cabecera">País: {{$pedido_compra->almacen->sujeto->direccion->pais}}</p> 
          </div>  
      </div>

      <div class="col-6  float-right  ">
        <div class="card-body ml-1">
          <h5 class="card-title">Proveedor</h5>
          <p class= "cabecera ">Código: {{$pedido_compra->proveedor->codigo}}</p> 
          <p class="cabecera">Nombre: {{$pedido_compra->proveedor->sujeto->nombre.' '. 
                                          $pedido_compra->proveedor->sujeto->primerApellido. ' '. 
                                             $pedido_compra->proveedor->sujeto->segundoApellido}}</p>
          <p class="cabecera">NIF: {{$pedido_compra->proveedor->sujeto->nif}}</p>
          <p class="cabecera">Email: {{$pedido_compra->proveedor->sujeto->email}}</p>
          <p class="cabecera">Teléfono: {{$pedido_compra->proveedor->sujeto->telefono}}</p>
          <p class="cabecera">Persona Contacto: {{$pedido_compra->proveedor->sujeto->personaContacto}}</p>
          <p class="cabecera">Dirección: {{$pedido_compra->proveedor->sujeto->direccion->direccion}}</p>
          <p class="cabecera">CP: {{$pedido_compra->proveedor->sujeto->direccion->codigoPostal}}</p>
          <p class="cabecera">Población: {{$pedido_compra->proveedor->sujeto->direccion->poblacion}}</p>
          <p class="cabecera">Provincia: {{$pedido_compra->proveedor->sujeto->direccion->provincia}}</p>
          <p class="cabecera">País: {{$pedido_compra->proveedor->sujeto->direccion->pais}}</p>
        </div>
      </div>
    </div> 

    <div class="w-100"></div>

      <div class="col  ">
        <div class="card-body">
          <h5 class="card-title ">Observaciones</h5>
          <textarea >{{$pedido_compra->observaciones}}</textarea> 
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
          <th scope="col">Precio</th>  
          <th scope="col">Importe</th>    
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
                      {{$linea->precio}}
                  </td>
                  <td>
                      {{$linea->importe}}
                  </td> 
              </tr>
          @endforeach
      </tbody>
  </table> 
</div> <!-- FIN TABLA -->



@endsection 