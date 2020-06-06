<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckProducto;
use App\Http\Requests\SaveProductoRequest;
use App\Impuesto;
use App\Marca;
use App\Producto;
use App\Subfamilia;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    private $numeroLinks = 15;



    public function __construct()
    { 
        $this->middleware('auth'); 
        $this->middleware(CheckProducto::class);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    
    public function index(Request $request)
    { 
        $nombre = $request->get('buscarpor');

        return view('articulos.productos.index',['productos' => 
                    Producto::join('marcas', 'marca_id', '=', 'marcas.id')
                        ->join('subfamilias', 'subfamilia_id', '=', 'subfamilias.id')
                        ->join('familias', 'subfamilias.familia_id', '=', 'familias.id') 
                        ->join('impuestos', 'impuesto_id', '=', 'impuestos.id')
                        ->whereRaw("UPPER(marcas.codigo) like  UPPER('%".$nombre."%') OR
                                    UPPER(marcas.nombre) like UPPER('%".$nombre."%') OR 

                                    UPPER(subfamilias.codigo) like UPPER('%".$nombre."%') OR 
                                    UPPER(subfamilias.nombre) like UPPER('%".$nombre."%') OR 
                                    
                                    UPPER(familias.codigo) like UPPER('%".$nombre."%') OR 
                                    UPPER(familias.nombre) like UPPER('%".$nombre."%') OR

                                    UPPER(impuestos.codigo) like UPPER('%".$nombre."%') OR
                                    UPPER(impuestos.nombre) like UPPER('%".$nombre."%') OR

                                    UPPER(productos.codigo) like UPPER('%".$nombre."%') OR
                                    UPPER(productos.nombre) like UPPER('%".$nombre."%')
                                ")
                     ->paginate($this->numeroLinks)] );
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 

        return view('articulos.productos.create', [
            'producto'=> new Producto,
            'marcas' => Marca::all(),
            'impuestos' => Impuesto::all(),
            'subfamilias' => Subfamilia::all()
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveProductoRequest $request)
    { 
        $this->authorize('modificarPanelProductos', new Producto);

        Producto::create($request->validated());
        return redirect()->route('productos.index')->with('status', 'El producto fue creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return view('articulos.productos.show', [
            'producto' => $producto
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {

        return view('articulos.productos.edit', [
            'producto' =>$producto, 
            'marcas' => Marca::all(),
            'impuestos' => Impuesto::all(),
            'subfamilias' => Subfamilia::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(SaveProductoRequest $request, Producto $producto)
    {
        $this->authorize('modificarPanelProductos', $producto);


        $producto->update($request->validated()); 
        return redirect()->route('productos.index')->with('status', 'El producto fue actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $this->authorize('modificarPanelProductos',  $producto);

        $puedeBorrarse = Producto::whereRaw('ID in (select distinct producto_id from movimientosalmacenes
                                                    union all 
                                                    select distinct producto_Id  from pedidocompralineas)')
                                    ->where('id', '=', $producto->id)  
                                    ->get()
                                    ->first(); 
        if($puedeBorrarse !== null)
            return redirect()->route('productos.show', $producto)->with('status', 'El producto no puede eliminarse. Está siendo utilizado en algún documento');


        $producto->delete(); 
        return redirect()->route('productos.index')->with('status', 'El producto fue eliminado con éxito');
    }
}
