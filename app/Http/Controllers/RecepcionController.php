<?php

namespace App\Http\Controllers;

use App\Almacen;
use App\Http\Requests\SaveRecepcionRequest;
use App\MovimientoAlmacen;
use App\PedidoCompra;
use App\PedidoCompraLinea;
use App\PedidoCompraLinea_RecepcionLinea;
use App\Producto;
use App\Proveedor;
use App\Recepcion;
use App\RecepcionLinea;
use App\TipoMovimientoAlmacen;
use App\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecepcionController extends Controller
{

    private $serie = 'RE';


    public function __construct()
    {
        // $this->authorize('verPanelRecepciones');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recepciones.index',['recepciones' => Recepcion::latest()->paginate(5)]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('escribirPanelRecepciones');

        return view('recepciones.create', [
            'recepcion'=> new Recepcion,  
            'lineas' => array(),
            'productos' => Producto::all(), 
            'proveedores' => Proveedor::all(),
            'almacenes' => Almacen::all(),  
        ]);  
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRecepcionRequest $request)
    { 
        $this->authorize('escribirPanelRecepciones');

        try{
            DB::beginTransaction();

            $recepcion = new Recepcion([
                'serie' => $this->serie,
                'numero' => Recepcion::max('numero')? (Recepcion::max('numero') +1): 1,
                'fecha' => $request->fecha,
                'observaciones' => $request->observaciones,
                'proveedor_id' => $request->proveedor_id,
                'almacen_id' => $request->almacen_id, 
                'usuario_id' => Auth::user()->id
            ]);$recepcion->save();


            foreach($request->lineas as  $linea){
               
                $lineaRecepcion = new RecepcionLinea([
                    'cantidad' => $linea['cantidad'], 
                    'recepcion_id' => $recepcion->id,  
                    'producto_id' => $linea['producto_id']
                ]);$lineaRecepcion->save();

                


                $movimientoAlmacen = new MovimientoAlmacen([
                    'tipoMovimientoAlmacen_id' => TipoMovimientoAlmacen::where('codigo', '=', 'ENREC')->first()->id,
                    'almacen_id' => $recepcion->almacen_id,
                    'producto_id' => $linea['producto_id'],
                    'documentoOrigen_id' => $lineaRecepcion->id,
                    'documentoOrigen_type' => RecepcionLinea::class
                ]);$movimientoAlmacen->save();

 
               //Si alguna de las lineas tiene vinculacion con una linea de pedido de compra, se asigna aqui 
               if(array_key_exists('pedidoCompraLinea_id', $linea)){
                             
                    $pedidoCompraLinea_RecepcionLinea = new PedidoCompraLinea_RecepcionLinea([
                        'pedidoCompraLinea_id'=> $linea['pedidoCompraLinea_id'],
                        'recepcionLinea_id'=> $lineaRecepcion->id
                    ]);
                    $pedidoCompraLinea_RecepcionLinea->timestamps = false;  //Desactivamos la actualizacion por created_at and updated-at
                    $pedidoCompraLinea_RecepcionLinea->save();
                
                    $pedidoCompraLinea_RecepcionLinea = null; 
                    //Actualizamos el pedido Origen
                } 


                $movimientoAlmacen = null;
                $lineaRecepcion = null;
            }

            DB::commit();
                
            return redirect()->route('recepciones.index')->with('status', 'La recepción fue creado con éxito');
        }catch(\Exception $e){
            DB::rollback(); 
            return redirect()->route('recepciones.index')->with('status', 'Ha ocurrido un error al crear la recepción. '. 'Mensaje de error: '.$e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function show(Recepcion $recepcion)
    {
        return view('recepciones.show', [
            'recepcion' => $recepcion
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function edit(Recepcion $recepcion)
    { 
        $this->authorize('escribirPanelRecepciones');

        return view('recepciones.edit', [
            'recepcion'=> $recepcion,  
            'lineas' => $recepcion->lineas,
            'productos' => Producto::all(), 
            'proveedores' => Proveedor::all(),
            'almacenes' => Almacen::all(),  
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRecepcionRequest $request, Recepcion $recepcion)
    {
        $this->authorize('escribirPanelRecepciones');

        try{

            DB::beginTransaction();

            //Creamos un array y obtenemos los distintos ids que devuelve el formulario
            //Es decir, si alguna línea tiene id significa que ya fue creada previamente
            //En caso de que haya sido borrada alguna, lo detectaremos borrando las lineas
            //que pertenezcan a la recepción en cuestión y que no estén en este array de ids
            $ids = array();
            foreach($request->lineas as $linea){ 
                if(array_key_exists('id', $linea)){
                    array_push($ids, $linea['id']);
                } 
            }

            //Borramos las lineas de la recepción que no pertenezcan al array
            $lineas = RecepcionLinea::where('recepcion_id', '=', $recepcion->id)
                                        ->whereNotIn('id', $ids)->delete();

                                     
            // Creamos las lineas que se han añadido y que carecen de id
            // Si carecen de id, significa que se han añadido a posteriori de crear el pedido de compra
                foreach($request->lineas as $linea){ 
                    if(!array_key_exists('id', $linea)){

                        $lineaRecepcion = new RecepcionLinea([
                            'cantidad' => $linea['cantidad'], 
                            'recepcion_id' => $recepcion->id, 
                            'producto_id' => $linea['producto_id']
                        ]);$lineaRecepcion->save();



                        $movimientoAlmacen = new MovimientoAlmacen([
                            'tipoMovimientoAlmacen_id' => TipoMovimientoAlmacen::where('codigo', '=', 'ENREC')->first()->id,
                            'almacen_id' => $recepcion->almacen_id,
                            'producto_id' => $linea['producto_id'],
                            'documentoOrigen_id' => $lineaRecepcion->id,
                            'documentoOrigen_type' => RecepcionLinea::class
                        ]);$movimientoAlmacen->save();

                        //Si alguna de las lineas tiene vinculacion con una linea de pedido de compra, se asigna aqui 
                        if(array_key_exists('pedidoCompraLinea_id', $linea)){
                             
                            $pedidoCompraLinea_RecepcionLinea = new PedidoCompraLinea_RecepcionLinea([
                                'pedidoCompraLinea_id'=> $linea['pedidoCompraLinea_id'],
                                'recepcionLinea_id'=> $lineaRecepcion->id
                            ]);
                            $pedidoCompraLinea_RecepcionLinea->timestamps = false;  //Desactivamos la actualizacion por created_at and updated-at
                            $pedidoCompraLinea_RecepcionLinea->save();
                        
                            $pedidoCompraLinea_RecepcionLinea = null; 
                            //Actualizamos el pedido Origen
                        } 
                        $movimientoAlmacen = null;
                        $lineaRecepcion = null;
                    } 
               } //Fin foreach

                
            //Actualizamos las lineas de la recepción
            foreach($request->lineas as $linea){ 
                if(array_key_exists('id', $linea)){

                   $recepcionLinea = RecepcionLinea::find($linea['id']);
                   $recepcionLinea->producto_id = $linea['producto_id'];
                   $recepcionLinea->cantidad = $linea['cantidad'];
                   $recepcionLinea->update();

                   //Actualizamos los datos del movimiento de almacen relacionado con la linea de recepcion 
                    $movimientoAlmacen = MovimientoAlmacen::where('documentoOrigen_id', '=', $recepcionLinea->id)
                                                    ->where('documentoOrigen_type', '=', RecepcionLinea::class ) 
                                                    ->get()
                                                    ->first();
                    if($movimientoAlmacen != null){
                        $movimientoAlmacen->almacen_id = $recepcion->almacen_id;
                        $movimientoAlmacen->producto_id = $recepcionLinea->producto_id;
                        $movimientoAlmacen->update();
                    }

                    //Si alguna de las lineas tiene vinculacion con una linea de pedido de compra, se actualizara la cantidad recibida
                    if(array_key_exists('pedidoCompraLinea_id', $linea)){
                        $pedidoLinea =  PedidoCompraLinea::find($linea['pedidoCompraLinea_id']);
                        $pedidoLinea->cantidadRecibida = $recepcionLinea->cantidad; 
                        $pedidoLinea->save(); 
                        //Actualizamos el pedido Origen
                    } 
                } 
            }

            //Actualizamos el pedido de venta 
            $recepcion->observaciones = $request->observaciones;
            $recepcion->proveedor_id = $request->proveedor_id;
            $recepcion->almacen_id = $request->almacen_id;  
            $recepcion->fecha = $request->fecha;
            $recepcion->update();
             
            DB::commit(); 
            return redirect()->route('recepciones.index')->with('status', 'La recepcion fue actualizada con éxito');
        }catch(\Exception $e){
            DB::rollback();  
            return redirect()->route('recepciones.index')->with('status', 'Ha ocurrido un error al actualizar la recepción. '. 'Mensaje de error: '.$e);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recepcion $recepcion)
    { 
        $this->authorize('escribirPanelRecepciones');

        $recepcion->delete(); 
        return redirect()->route('recepciones.index')->with('status', 'La recepcion fue eliminado con éxito');
    }

    /* FUNCIONES ADICIONALES */
    //Utilizaremos esta función para poder añadir rows en la tabla
    public function anadirLineaTabla(Request  $request){
         
        $indice = $request->indice; 
        $numero = $indice +1;

        echo  
            '
        <tr> 
        <td> <!-- Producto -->
            <select class="clase-cajatexto"
                required
                id="lineas['.$indice.'][producto_id]" 
                name="lineas['.$indice.'][producto_id]" >';
 
                    foreach (Producto::all() as $producto){
                    echo '
                            <option 
                                value="'.$producto->id.'" 
                                >'.$producto->codigo.' --  '.$producto->nombre 
                            .'</option>
                            ';  
                    }

            echo '   </select>  
            </td> 

            <td> <!-- Cantidad -->
            <input class="clase-cajatexto" 
                    required
                    min="1" 
                    id="lineas['.$indice.'][cantidad]"
                    type="number" 
                    name="lineas['.$indice.'][cantidad]" 
                    value="0"> 
            </td> 
            
        <td> 
            <input class="btn btn-danger btn-sm btn-block eliminarLineaPedido"  
                    type="button"
                    value="Eliminar"> 
        </td>
        </tr> 
        
        ';
 
    }


    //Obtenemos todos los pedidos del proveedor que haya seleccionado el usuario
    public function listaPedidosPorProveedor(Request $request){

        $proveedor_id = $request['proveedor_id'];

        $pedidos = PedidoCompra::where('proveedor_id','=', $proveedor_id) 
                            ->whereRaw("estadoPedido_id in (select id from pedidocompraestados where estado in ('Pendiente'))")
                            ->whereHas('lineas', function($query) {
                                $query->whereRaw("lineaPedidoEstado_id in (select id from pedidocompralineaestados where estado in ('Pendiente'))"); 
                             })
                            ->get();
 
         $datos = '';

         foreach($pedidos as $pedido){ 
              
            //Cargamos las cabecera de cada pedido y posteriormente sus lineas
          
            $datos .='<form  class="clase-formulario">
                <fieldset class="form-group">
                    <legend>
                        Pedido: '. $pedido->serie.'/'.$pedido->numero.'. Fecha: '.$pedido->fecha.'. Estado: '.$pedido->estado->estado.
                    '</legend>';
 
                $lineas = PedidoCompraLinea::where('pedidoCompra_id', '=', $pedido->id)
                        ->whereRaw("lineaPedidoEstado_id in (select id from pedidocompralineaestados where estado in ('Pendiente'))") 
                        ->orderBy('producto_id')
                        ->get();
                
 
                foreach($lineas as $key=>$linea){  
                    $datos .= '
                    <div  >
                        <label>
                        <input type="checkbox" 
                                class ="lineasPedido-items"
                                id="'.$linea->id.'"
                                name="pedidoLineas['.$key.']" 
                                value="">
                        <span>Producto: <strong>'.$linea->producto->nombre.'. </strong></span>
                        <span>Cantidad pend. recibir: <strong>'.($linea->cantidad -  $linea->cantidadRecibida).' ud.</strong> </span>
                        </label>
                    </div>';
                    }

                    $datos .= '</fieldset> </form>';  
        }

        if($datos === '') echo 'No hay pedidos pendientes de servir';
        else echo $datos;
                 
    }


    //Function utilizada para añadir en la recepción en curso los pedidos seleccionados desde la ventana modal
    public function anadirLineaPedidoEnRecepcion(Request $request){
        $listaIds = $request->lineasPedido_id; 
        $lineas = PedidoCompraLinea::whereIn('id', $listaIds)
                                ->get();
 
        $indice = $request->indice;  
        $row = "";

        foreach($lineas as $linea){ 

            $row .= 
                '
            <tr> 
                <td> <!-- Producto -->
                    <select class="clase-cajatexto"
                        required
                        id="lineas['.$indice.'][producto_id]" 
                        name="lineas['.$indice.'][producto_id]" > 
                            <option 
                                value="'.$linea->producto_id.'" 
                                >'.$linea->producto->codigo.' -- '.$linea->producto->nombre 
                            .'</option>
                  </select>  
                </td> 

                <td> <!-- Cantidad -->
                <input class="clase-cajatexto" 
                        required
                        min="1" 
                        id="lineas['.$indice.'][cantidad]"
                        type="number" 
                        name="lineas['.$indice.'][cantidad]" 
                        value="'.($linea->cantidad - $linea->cantidadRecibida).'"> 
                </td> 
                
            <td> 
                <input class="btn btn-danger btn-sm btn-block eliminarLineaPedido"  
                        type="button"
                        value="Eliminar"> 
            </td>
            <td> <!-- ID de la linea del pedido de compra -->
                <input class="clase-cajatexto row-lineaPedido" 
                        required
                        hidden
                        id="lineas['.$indice.'][pedidoCompraLinea_id]"
                        type="number" 
                        name="lineas['.$indice.'][pedidoCompraLinea_id]" 
                        value="'.$linea->id.'"> 
                </td> 
            </tr> 
            
            ';
            $indice = $indice+1;
        }

  
        return response()->json(['indice'=>$indice,'row'=>$row]);
    }

}
