<?php

namespace App\Http\Controllers;

use App\Almacen;
use App\ClaveMovimiento;
use App\Http\Requests\SavePedidoCompraRequest;
use App\MovimientoAlmacen;
use App\PedidoCompra;
use App\PedidoCompraEstado;
use App\PedidoCompraLinea;
use App\PedidoCompraLineaEstado;
use App\Producto;
use App\Proveedor;
use App\TipoMovimientoAlmacen;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PedidosEstados;

class PedidoCompraController extends Controller
{

    private $serie = 'PE';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        return view('pedidos.index',['pedidos_compra' => PedidoCompra::latest()->paginate(5)]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pedidos.create', [
            'pedido_compra'=> new PedidoCompra,  
            'lineas' => array(),
            'productos' => Producto::all(), 
            'proveedores' => Proveedor::all(),
            'almacenes' => Almacen::all(), 
            'estados' => array(PedidoCompraEstado::where('estado', '=', 'Pendiente')->first()),
            'linea_estados' => PedidoCompraLineaEstado::all()
        ]); 
    }

    //Utilizaremos esta funcion para buscar el precio del producto seleccionado en el escenario de creación de pedidos de compra
    public function buscarPrecioProducto(Request $request){
        
        $producto = Producto::where('id', '=', $request->producto_id)
                            ->get()
                            ->first();
  

        return  response()->json(['producto' => $producto]);  
                          
    }

    //Utilizaremos esta función para poder añadir rows en la tabla
    public function anadirLineaTabla(Request  $request){
        
        $estado = PedidoCompraLineaEstado::where('estado', '=', 'Pendiente')->first(); 
        $indice = $request->indice;  
        $precioPrimerProducto = 0;

        echo  
            '
        <tr> 
        <td> <!-- Producto -->
            <select class="clase-cajatexto buscarPrecioProducto"
                required
                id="lineas['.$indice.'][producto_id]" 
                name="lineas['.$indice.'][producto_id]" >';
 
                    foreach (Producto::all() as $key => $producto){
                    echo '
                            <option 
                                value="'.$producto->id.'" 
                                >'.$producto->codigo.' --  '.$producto->nombre 
                            .'</option>
                            ';
                            //Buscamos el precio del primer elemento del selector de items
                            if($key == 0) $precioPrimerProducto = $producto->precio;
                    }

            echo '   </select>  
            </td> 

            <td> <!-- Cantidad -->
            <input class="clase-cajatexto calcularImporteLineaPedido" 
                    required
                    min="1" 
                    id="lineas['.$indice.'][cantidad]"
                    type="number" 
                    name="lineas['.$indice.'][cantidad]" 
                    value="0"> 
            </td> 
            <td> <!-- Precio -->
            <input class="clase-cajatexto calcularImporteLineaPedido" 
                    step= "0.01"
                    required
                    min="0" 
                    id="lineas['.$indice.'][precio]"
                    type="number" 
                    name="lineas['.$indice.'][precio]" 
                    value="'.$precioPrimerProducto.'"> 
            </td>
            <td> <!-- Importe -->
            <input class="clase-cajatexto"
                    required
                    min="0" 
                    readonly
                    id="lineas['.$indice.'][importe]"
                    type="number" 
                    name="lineas['.$indice.'][importe]" 
                    value="0"> 
            </td>
            <td>
            <select class="clase-cajatexto"
                    required
                    id="lineas['.$indice.'][estadoLinea_id]" 
                    name="lineas['.$indice.'][estadoLinea_id]" >'; 
                
                // foreach (PedidoCompraLineaEstado::all() as $estado){
                    echo ' 
                       <option 
                            value="'.$estado->id.'" 
                            > '.$estado->estado 
                        .'</option>  
                        ';
                // }
        echo '
            </select>  
        </td>
        <td> 
            <input class="btn btn-danger btn-sm btn-block eliminarLineaPedido"  
                    type="button"
                    value="Eliminar"> 
        </td>
        </tr> 
        
        ';
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePedidoCompraRequest $request)
    {   
          
        try{
            DB::beginTransaction();

            $pedidoCompra = new PedidoCompra([
                'serie' => $this->serie,
                'numero' => PedidoCompra::max('numero')? (PedidoCompra::max('numero') +1): 1,
                'fecha' => $request->fecha,
                'observaciones' => $request->observaciones,
                'proveedor_id' => $request->proveedor_id,
                'almacenDestinoCompra_id' => $request->almacenDestinoCompra_id,
                'estadoPedido_id'=> $request->estadoPedido_id,
                'usuario_id' => User::firstOrFail()->id
            ]);$pedidoCompra->save();


            foreach($request->lineas as  $linea){
              

                // $movimientoAlmacen = new MovimientoAlmacen([
                //     'tipoMovimientoAlmacen_id' => TipoMovimientoAlmacen::where('codigo', '=', 'ENPED')->first()->id,
                //     'almacen_id' => $pedidoCompra->almacenDestinoCompra_id,
                //     'producto_id' => $linea['producto_id']
                // ]);$movimientoAlmacen->save();

                $lineaPedido = new PedidoCompraLinea([
                    'cantidad' => $linea['cantidad'],
                    'precio' => $linea['precio'],
                    'importe' => $linea['importe'],
                    'cantidadRecibida' => 0,
                    'pedidoCompra_id' => $pedidoCompra->id,
                   // 'movimientoAlmacen_id' => $movimientoAlmacen->id,
                    'lineaPedidoEstado_id' => $linea['estadoLinea_id'],
                    'producto_id' => $linea['producto_id']
                ]);$lineaPedido->save();



                // $movimientoAlmacen = new MovimientoAlmacen([
                //     'tipoMovimientoAlmacen_id' => TipoMovimientoAlmacen::where('codigo', '=', 'ENPED')->first()->id,
                //     'almacen_id' => $pedidoCompra->almacenDestinoCompra_id,
                //     'producto_id' => $linea['producto_id'],
                //     'documentoOrigen_id' => $lineaPedido->id,
                //     'documentoOrigen_type' => PedidoCompraLinea::class
                // ]);$movimientoAlmacen->save();


                $movimientoAlmacen = null;
                $lineaPedido = null;
            }

            DB::commit();
                
            return redirect()->route('pedidos_compra.index')->with('status', 'El pedido fue creado con éxito');
        }catch(\Exception $e){
            DB::rollback(); 
            return redirect()->route('pedidos_compra.index')->with('status', 'Ha ocurrido un error al crear el pedido. '. 'Mensaje de error: '.$e);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PedidoCompra  $pedidoCompra
     * @return \Illuminate\Http\Response
     */
    public function show(PedidoCompra $pedidoCompra)
    {
        return view('pedidos.show', [
            'pedido_compra' => $pedidoCompra
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PedidoCompra  $pedidoCompra
     * @return \Illuminate\Http\Response
     */
    public function edit(PedidoCompra $pedidoCompra)
    {  

        return view('pedidos.edit', [
            'pedido_compra'=> $pedidoCompra,  
            'lineas' => $pedidoCompra->lineas,
            'productos' => Producto::all(), 
            'proveedores' => Proveedor::all(),
            'almacenes' => Almacen::all(), 
            'estados' => PedidoCompraEstado::all(),
            'linea_estados' => PedidoCompraLineaEstado::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PedidoCompra  $pedidoCompra
     * @return \Illuminate\Http\Response
     */
    public function update(SavePedidoCompraRequest $request, PedidoCompra $pedidoCompra)
    {
        try{

            DB::beginTransaction();

            //Creamos un array y obtenemos los distintos ids que devuelve el formulario
            //Es decir, si alguna línea tiene id significa que ya fue creada previamente
            //En caso de que haya sido borrada alguna, lo detectaremos borrando las lineas
            //que pertenezcan al pedido de compra en cuestión y que no estén en este array de ids
            $ids = array();
            foreach($request->lineas as $linea){ 
                if(array_key_exists('id', $linea)){
                    array_push($ids, $linea['id']);
                } 
            }

            //Borramos las lineas de pedido que no pertenezcan al array
            $lineas = PedidoCompraLinea::where('pedidoCompra_id', '=', $pedidoCompra->id)
                                        ->whereNotIn('id', $ids)->delete();

            // Creamos las lineas que se han añadido y que carecen de id
            // Si carecen de id, significa que se han añadido a posteriori de crear el pedido de compra
                foreach($request->lineas as $linea){ 
                    if(!array_key_exists('id', $linea)){

                        // $movimientoAlmacen = new MovimientoAlmacen([
                        //     'tipoMovimientoAlmacen_id' => TipoMovimientoAlmacen::where('codigo', '=', 'ENPED')->first()->id,
                        //     'almacen_id' => $pedidoCompra->almacenDestinoCompra_id,
                        //     'producto_id' => $linea['producto_id']
                        // ]);$movimientoAlmacen->save();

                        $lineaPedido = new PedidoCompraLinea([
                            'cantidad' => $linea['cantidad'],
                            'precio' => $linea['precio'],
                            'importe' => $linea['importe'],
                            'cantidadRecibida' => 0,
                            'pedidoCompra_id' => $pedidoCompra->id,
                            //'movimientoAlmacen_id' => $movimientoAlmacen->id,
                            'lineaPedidoEstado_id' => $linea['estadoLinea_id'],
                            'producto_id' => $linea['producto_id']
                        ]);$lineaPedido->save();


                        // $movimientoAlmacen = new MovimientoAlmacen([
                        //     'tipoMovimientoAlmacen_id' => TipoMovimientoAlmacen::where('codigo', '=', 'ENPED')->first()->id,
                        //     'almacen_id' => $pedidoCompra->almacenDestinoCompra_id,
                        //     'producto_id' => $linea['producto_id'],
                        //     'documentoOrigen_id' => $lineaPedido->id,
                        //     'documentoOrigen_type' => PedidoCompraLinea::class
                        // ]);$movimientoAlmacen->save();


                        $movimientoAlmacen = null;
                        $lineaPedido = null;
                    } 
               } //Fin foreach

            //Actualizamos las lineas del pedido de compra
            foreach($request->lineas as $linea){ 
                if(array_key_exists('id', $linea)){
                    PedidoCompraLinea::find($linea['id'])->update($linea);
                } 
            }

            //Actualizamos el pedido de venta 
            $pedidoCompra->observaciones = $request->observaciones;
            $pedidoCompra->proveedor_id = $request->proveedor_id; 
            $pedidoCompra->almacenDestinoCompra_id = $request->almacenDestinoCompra_id;
            $pedidoCompra->estadoPedido_id = $request->estadoPedido_id; 
            $pedidoCompra->fecha = $request->fecha;
            $pedidoCompra->update();
             
            DB::commit(); 
            return redirect()->route('pedidos_compra.index')->with('status', 'El pedido fue actualizado con éxito');
        }catch(\Exception $e){
            DB::rollback(); 
            return redirect()->route('pedidos_compra.index')->with('status', 'Ha ocurrido un error al actualizar el pedido. '. 'Mensaje de error: '.$e);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PedidoCompra  $pedidoCompra
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidoCompra $pedidoCompra)
    { 
        $pedidoCompra->delete(); 
        return redirect()->route('pedidos_compra.index')->with('status', 'El pedido fue eliminado con éxito');
    }
}
