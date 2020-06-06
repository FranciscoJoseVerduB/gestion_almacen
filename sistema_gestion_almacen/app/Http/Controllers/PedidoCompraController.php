<?php

namespace App\Http\Controllers;

use App\Almacen;
use App\ClaveMovimiento;
use App\Http\Middleware\CheckPedidoCompra;
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
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PedidosEstados;
use Barryvdh\DomPDF\Facade as PDF;

class PedidoCompraController extends Controller
{

    private $serie = 'PE';
    private $numeroLinks = 15;


    public function __construct()
    { 
        $this->middleware('auth'); 
        $this->middleware(CheckPedidoCompra::class);
    }
   
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $nombre = $request->get('buscarpor');

        return view('pedidos.index',['pedidos_compra' => 
                  PedidoCompra::join('almacenes', 'almacenDestinoCompra_ID', '=', 'almacenes.id')
                        ->join('sujetos as suj1', 'almacenes.sujeto_id', '=', 'suj1.id')
                        ->join('proveedores', 'proveedor_id', '=', 'proveedores.id')
                        ->join('sujetos as suj2', 'proveedores.sujeto_id', '=', 'suj2.id')
                        ->whereRaw("UPPER(almacenes.codigo) =  UPPER('".$nombre."') OR
                                    UPPER(proveedores.codigo) = UPPER('".$nombre."') OR 
                                    UPPER(suj1.nombre) like UPPER('%".$nombre."%') OR
                                    UPPER(suj2.nombre) like UPPER('%".$nombre."%') or
                                    UPPER(pedidoscompras.fecha) like UPPER('%".$nombre."%') or
                                    UPPER(CONCAT(Serie, '/', numero)) = UPPER('".$nombre."')
                                ")
                        ->orderBy('pedidoscompras.created_at', 'DESC')
                     ->paginate($this->numeroLinks)] ); 
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

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePedidoCompraRequest $request)
    {   
          
        $this->authorize('modificarPanelPedidos',  PedidoCompra::class);


        try{
            DB::beginTransaction();

            $pedidoCompra = new PedidoCompra([
                'serie' => $this->serie,
                'numero' => PedidoCompra::max('numero')? (PedidoCompra::max('numero') +1): 1,
                'fecha' => $request->fecha,
                'observaciones' => trim($request->observaciones),
                'proveedor_id' => $request->proveedor_id,
                'almacenDestinoCompra_id' => $request->almacenDestinoCompra_id,
                'estadoPedido_id'=> $request->estadoPedido_id,
                'usuario_id' => Auth::user()->id
            ]);$pedidoCompra->save();


            foreach($request->lineas as  $linea){
               

                $lineaPedido = new PedidoCompraLinea([
                    'cantidad' => $linea['cantidad'],
                    'precio' => $linea['precio'],
                    'importe' => $linea['importe'],
                    'cantidadRecibida' => 0,
                    'pedidoCompra_id' => $pedidoCompra->id, 
                    'lineaPedidoEstado_id' => $linea['estadoLinea_id'],
                    'producto_id' => $linea['producto_id']
                ]);$lineaPedido->save(); 
 
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
        // $this->visualizarDocumento($pedidoCompra);

        // $data = [
        //     'pedido_compra' =>$pedidoCompra
        // ];
     
        // return PDF::loadView('pedidos.documentos.doc-pdf', $data)->stream('pedido_'.$pedidoCompra->serie.'/'.$pedidoCompra->numero.'.pdf');



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
        
        $this->authorize('modificarPanelPedidos', $pedidoCompra);

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
 
                        $lineaPedido = new PedidoCompraLinea([
                            'cantidad' => $linea['cantidad'],
                            'precio' => $linea['precio'],
                            'importe' => $linea['importe'],
                            'cantidadRecibida' => 0,
                            'pedidoCompra_id' => $pedidoCompra->id, 
                            'lineaPedidoEstado_id' => $linea['estadoLinea_id'],
                            'producto_id' => $linea['producto_id']
                        ]);$lineaPedido->save();

 
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
            $pedidoCompra->observaciones = trim($request->observaciones);
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
        $this->authorize('modificarPanelPedidos', $pedidoCompra);
 
        if($pedidoCompra->estado->estado === 'Servido')
            return redirect()->route('pedidos_compra.show', $pedidoCompra)->with('status', 'No se puede eliminar el pedido. Esta servido');


        foreach($pedidoCompra->lineas as $linea){
            if($linea->estado->estado === 'ParcialmenteServido' ||
                $linea->estado->estado === 'Servido')
                return redirect()->route('pedidos_compra.show', $pedidoCompra)->with('status', 'No se puede eliminar el pedido. Alguna de sus lineas estan servidas');
        }


        $pedidoCompra->delete(); 
        return redirect()->route('pedidos_compra.index')->with('status', 'El pedido fue eliminado con éxito');
    }


    /* Funciones adicionales */
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



    
    public function visualizarDocumento($pedidoCompra){
        $data = [
            'pedido_compra' =>$pedidoCompra
        ];
     
        return PDF::loadView('pedidos.documentos.doc-pdf', $data)->stream('pedido_'.$pedidoCompra->serie.'/'.$pedidoCompra->numero.'.pdf');
    }

}
