<table class="table   table-responsive-sm table-sm table-striped table-bordered table-hover  shadow">
    <thead  class="bg-info text-white">
      <tr> 
          @foreach($columnas as $columna)
            <th scope="col">{{$columna}}</th>
          @endforeach
      </tr>
    </thead>
    <tbody> 
        <tr> 
            @foreach($filas as $fila)
                @if($loop->first)
                  <th scope="row">{{$fila}} </th>
                @else
                  <td>{{$fila}} </td>
                @endif 
             @endforeach
        </tr>  
    </tbody>
</table>

