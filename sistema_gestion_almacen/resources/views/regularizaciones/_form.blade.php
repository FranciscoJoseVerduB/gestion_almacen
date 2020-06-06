 
    @csrf 

<div class="form-row"> 
    <div class="form-group   mr-auto">
        <label for="fecha"> Fecha </label> 
        <input class="clase-cajatexto"
            required
            id="fecha"
            type="date" 
            name="fecha" 
            value="{{old('fecha', $regularizacion_manual->fecha)}}">     
    </div>

      
 
    <div class="form-group  mr-auto">
        <label for="almacenDestinoCompra_id"> Almacen </label> 
        <select class="clase-cajatexto"
            required
            id="almacen_id" 
            name="almacen_id" > 
            
            @foreach ($almacenes as $almacen)
                <option 
                    value="{{$almacen->id}}"
                    {{setSelectedCombobox(old('almacen_id', $regularizacion_manual->almacen_id), $almacen->id)}}
                    > {{$almacen->codigo . ' -- ' . $almacen->sujeto->nombre }}
                </option>  
            @endforeach 
        </select>  
    </div> 
</div>
    <div class="form-group  mr-auto">
        <label for="observaciones"> Observaciones </label> 

        <textarea class="clase-cajatexto" 
                name="observaciones" 
                id="observaciones"
                >{{old('observaciones', $regularizacion_manual->observaciones)}}
            </textarea>  
    </div>
    
 <hr>

 
 <div class="table-responsive">
    <div class="d-flex align-items-baseline float-right my-2"> 
        <input class="btn btn-primary btn-sm btn-block anadirLineaRegularizacionManual"  
            type="button"      
            value="Añadir linea"> 
    </div>
 

    <table  class="table table-sm table-striped table-bordered table-hover shadow">
        <thead  class="bg-info text-white">
          <tr> 
            <th scope="col">Producto</th>
            <th scope="col">Cantidad Real Stock</th>   
            <th class=" text-center" scope="col">Operación</th>
          </tr>
        </thead>
        <tbody> 

            @if($btnText ==='Editar')
                @include('regularizaciones.lineas._table-edit')  
            @endif

        </tbody>
    </table>

</div>

<hr>     
<button class="btn btn-primary btn-lg btn-block"  
    type="submit" 
    >{{$btnText}}
</button>
<a class="btn btn-link btn-block"
    href="{{ route('regularizaciones_manual.index') }}"
    >Cancelar   
</a>