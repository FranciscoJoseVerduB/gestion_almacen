<?php

namespace App\Http\Controllers;

use App\Almacen;
use App\Http\Middleware\CheckStock;
use App\Http\Requests\SaveRegularizacionRequest;
use App\MovimientoAlmacen;
use App\Producto;
use App\RegularizacionManual;
use App\RegularizacionManualLinea;
use App\Stock;
use App\TipoMovimientoAlmacen;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegularizacionManualController extends Controller
{

    private $serie = 'RG';
 
    
    public function __construct()
    {
        $this->middleware(CheckStock::class);
    }
   


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('regularizaciones.index',['regularizaciones_manual' => RegularizacionManual::latest()->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('escribirPanelStock');

        return view('regularizaciones.create', [
            'regularizacion_manual'=> new RegularizacionManual,
            'lineas' => array(),
            'productos' => Producto::all(),
            'almacenes' => Almacen::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRegularizacionRequest $request)
    {
        $this->authorize('escribirPanelStock');

        try{
            DB::beginTransaction();

            $regularizacionManual = new RegularizacionManual([
                'serie' => $this->serie,
                'numero' => RegularizacionManual::max('numero')? (RegularizacionManual::max('numero') +1): 1,
                'fecha' => $request->fecha,
                'observaciones' => $request->observaciones,
                'almacen_id' => $request->almacen_id,
                'usuario_id' => Auth::user()->id
            ]);$regularizacionManual->save();


            foreach($request->lineas as  $linea){
 
                // Obtenemos la cantidad de producto existente en stock en el almacen seleccionado
                $cantidad = Stock::where('almacen_id', '=', $regularizacionManual->almacen_id)
                                    ->where('producto_id', '=', $linea['producto_id'])
                                    ->get()
                                    ->sum('cantidad');
             
                $cantidad == null? $cantidad= 0: '';

                // Obtenemos la cantidad que figurará en el documento
                // Restamos la cantidad que ha puesto el usuario a la cantidad que figura teóricamente
                // Si la cantidad es inferior a 0, el movimiento de almacén se hará de salida
                // Si la cantidad es igual o superior a 0, será de entrada
                $cantidadFinalRegularizada = $linea['cantidad'] - $cantidad;
                 
                $idTipoMovimientoAlmacen = 0;
                if($cantidadFinalRegularizada < 0) {
                    $idTipoMovimientoAlmacen = TipoMovimientoAlmacen::where('codigo', '=', 'SAREG')->first()->id; 
                    
                    //Multiplicamos por -1 para que la cantidad salga en positivo 
                    $cantidadFinalRegularizada = $cantidadFinalRegularizada * -1;
                }
                else $idTipoMovimientoAlmacen = TipoMovimientoAlmacen::where('codigo', '=', 'ENREG')->first()->id; 



                $lineaRegularizacion = new RegularizacionManualLinea([
                    'cantidad' => $cantidadFinalRegularizada, 
                    'regularizacionManual_id' => $regularizacionManual->id,
                    'producto_id' => $linea['producto_id']
                ]);$lineaRegularizacion->save();

               

                $movimientoAlmacen = new MovimientoAlmacen([
                    'tipoMovimientoAlmacen_id' => $idTipoMovimientoAlmacen,
                    'almacen_id' => $regularizacionManual->almacen_id,
                    'producto_id' => $linea['producto_id'],
                    'documentoOrigen_id' => $lineaRegularizacion->id,
                    'documentoOrigen_type' => RegularizacionManualLinea::class
                ]);$movimientoAlmacen->save();


                $movimientoAlmacen = null;
                $lineaRegularizacion = null;
            }

            DB::commit();

            return redirect()->route('regularizaciones_manual.index')->with('status', 'La regularizacion se ha producido con éxito');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('regularizaciones_manual.index')->with('status', 'Ha ocurrido un error al regularizar. '. 'Mensaje de error: '.$e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RegularizacionManual  $regularizacionManual
     * @return \Illuminate\Http\Response
     */
    public function show(RegularizacionManual $regularizacionManual)
    {
        return view('regularizaciones.show', [
            'regularizacion_manual' => $regularizacionManual
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegularizacionManual  $regularizacionManual
     * @return \Illuminate\Http\Response
     */
    public function edit(RegularizacionManual $regularizacionManual)
    {
        $this->authorize('escribirPanelStock');
        
        return view('regularizaciones.edit', [
            'regularizacion_manual'=> $regularizacionManual,
            'lineas' => $regularizacionManual->lineas,
            'productos' => Producto::all(),
            'almacenes' => Almacen::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegularizacionManual  $regularizacionManual
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRegularizacionRequest $request, RegularizacionManual $regularizacionManual)
    {
        $this->authorize('escribirPanelStock');

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
            $lineas = RegularizacionManualLinea::where('regularizacionManual_id', '=', $regularizacionManual->id)
                                        ->whereNotIn('id', $ids)->delete();

            // Creamos las lineas que se han añadido y que carecen de id
            // Si carecen de id, significa que se han añadido a posteriori de crear el pedido de compra
                foreach($request->lineas as $linea){
                    if(!array_key_exists('id', $linea)){


                        // Obtenemos la cantidad de producto existente en stock en el almacen seleccionado
                        $cantidad = Stock::where('almacen_id', '=', $regularizacionManual->almacen_id)
                                            ->where('producto_id', '=', $linea['producto_id'])
                                            ->get()
                                            ->sum('cantidad');
                    
                        $cantidad == null? $cantidad= 0: '';

                        // Obtenemos la cantidad que figurará en el documento
                        // Restamos la cantidad que ha puesto el usuario a la cantidad que figura teóricamente
                        // Si la cantidad es inferior a 0, el movimiento de almacén se hará de salida
                        // Si la cantidad es igual o superior a 0, será de entrada
                        $cantidadFinalRegularizada = $linea['cantidad'] - $cantidad;
                        
                        $idTipoMovimientoAlmacen = 0;
                        if($cantidadFinalRegularizada < 0) {
                            $idTipoMovimientoAlmacen = TipoMovimientoAlmacen::where('codigo', '=', 'SAREG')->first()->id; 
                            
                            //Multiplicamos por -1 para que la cantidad salga en positivo 
                            $cantidadFinalRegularizada = $cantidadFinalRegularizada * -1;
                        }
                        else $idTipoMovimientoAlmacen = TipoMovimientoAlmacen::where('codigo', '=', 'ENREG')->first()->id; 



                        $lineaRegularizacion = new RegularizacionManualLinea([
                            'cantidad' => $cantidadFinalRegularizada, 
                            'regularizacionManual_id' => $regularizacionManual->id,
                            'producto_id' => $linea['producto_id']
                        ]);$lineaRegularizacion->save();

                    

                        $movimientoAlmacen = new MovimientoAlmacen([
                            'tipoMovimientoAlmacen_id' => $idTipoMovimientoAlmacen,
                            'almacen_id' => $regularizacionManual->almacen_id,
                            'producto_id' => $linea['producto_id'],
                            'documentoOrigen_id' => $lineaRegularizacion->id,
                            'documentoOrigen_type' => RegularizacionManualLinea::class
                        ]);$movimientoAlmacen->save();

                    }
               } //Fin foreach

            //Actualizamos las lineas del pedido de compra
            foreach($request->lineas as $linea){
                if(array_key_exists('id', $linea)){
                    RegularizacionManualLinea::find($linea['id'])->update($linea);
                }
            }

            //Actualizamos el pedido de venta
            $regularizacionManual->observaciones = $request->observaciones;
            $regularizacionManual->almacen_id = $request->almacen_id;
            $regularizacionManual->fecha = $request->fecha;
            $regularizacionManual->update();

            DB::commit();
            return redirect()->route('regularizaciones_manual.index')->with('status', 'Se ha regularizado con éxito');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('regularizaciones_manual.index')->with('status', 'Ha ocurrido un error al regularizar. '. 'Mensaje de error: '.$e);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegularizacionManual  $regularizacionManual
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegularizacionManual $regularizacionManual)
    {
        $this->authorize('escribirPanelStock');
        
        $regularizacionManual->delete();
        return redirect()->route('regularizaciones_manual.index')->with('status', 'La regularizacion fue eliminada con éxito');
    }




    // Funciones adicionales


    //Utilizaremos esta función para poder añadir rows en la tabla
    public function anadirLineaTabla(Request  $request){

        $indice = $request->indice;

        echo
            '
        <tr>
        <td> <!-- Producto -->
            <select class="clase-cajatexto  "
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
                    }

            echo '   </select>
            </td>

            <td> <!-- Cantidad -->
            <input class="clase-cajatexto  "
                    required
                    min="1"
                    id="lineas['.$indice.'][cantidad]"
                    type="number"
                    name="lineas['.$indice.'][cantidad]"
                    value="0">
            </td>


        <td>
            <input class="btn btn-danger btn-sm btn-block eliminarLineaRegularizacionManual"
                    type="button"
                    value="Eliminar">
        </td>
        </tr>

        ';

    }



}
