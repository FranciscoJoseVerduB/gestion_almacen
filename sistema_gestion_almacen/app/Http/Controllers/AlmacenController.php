<?php

namespace App\Http\Controllers;

use App\Almacen; 
use App\Sujeto;
use App\Direccion;
use App\Geolocalizacion;
use App\Http\Middleware\CheckAlmacen;
use App\Http\Requests\SaveAlmacenRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmacenController extends Controller
{
    private $numeroLinks = 15;

    public function __construct()
    { 
        $this->middleware('auth'); 
        $this->middleware(CheckAlmacen::class);
        
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $nombre = $request->get('buscarpor');

        return view('almacenes.index',['almacenes' => Almacen::join('sujetos', 'sujeto_id', '=', 'sujetos.id') 
                    ->whereRaw(" UPPER(sujetos.nombre) like UPPER('%".$nombre."%') OR 
                                    UPPER(almacenes.codigo) like UPPER('%".$nombre."%')")
                    ->orderBy('almacenes.created_at', 'DESC')
                    ->paginate($this->numeroLinks)] );
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('almacenes.create', [
            'almacen'=> new Almacen(), 
            'sujeto' => new Sujeto(),
            'direccion' => new Direccion(),
            'geolocalizacion' => new Geolocalizacion()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveAlmacenRequest $request)
    {
        $this->authorize('modificarPanelAlmacenes', Almacen::class);

        try{
            $direccion = new Direccion([
                'direccion' => $request['direccion'],
                'poblacion' => $request['poblacion'],
                'codigoPostal' => $request['codigoPostal'],
                'provincia' => $request['provincia'],
                'pais' => $request['pais']
            ]); $direccion->save();

 
            $sujeto = new Sujeto([
                'nombre' => $request['nombre'],
                'primerApellido' => $request['primerApellido'],
                'segundoApellido' => $request['segundoApellido'],
                'nif' => $request['nif'],
                'email' => $request['email'],
                'telefono' => $request['telefono'],
                'personaContacto' => $request['personaContacto'],
                'paginaWeb' => $request['paginaWeb'],
                'direccion_id' => $direccion->id
            ]); $sujeto->save(); 

            $geolocalizacion = new Geolocalizacion([
                'latitud' => 0,
                'longitud' => 0 
            ]); $geolocalizacion->save();

            $almacen = new Almacen([
                'codigo' => $request['codigo'],
                'sujeto_id' => $sujeto->id,
                'geolocalizacion_id' => $geolocalizacion->id
            ]); $almacen->save();
        
            DB::commit();
            
            return redirect()->route('almacenes.index')->with('status', 'El almacen fue creado con éxito');
        }catch(\Exception $e){
            DB::rollback(); 
            return redirect()->route('almacenes.index')->with('status', 'Ha ocurrido un error al crear el almacen'. 'Mensaje de error: '.$e);
        }
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function show(Almacen $almacen)
    {         
        return view('almacenes.show', [
            'almacen' => $almacen
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function edit(Almacen $almacen)
    {
        return view('almacenes.edit', [
            'almacen' =>$almacen,  
            'sujeto' => $almacen->sujeto,
            'direccion' => $almacen->sujeto->direccion,
            'geolocalizacion' => $almacen->geolocalizacion
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function update(SaveAlmacenRequest $request, Almacen $almacen)
    {
        $this->authorize('modificarPanelAlmacenes', $almacen);
        
        $almacen->sujeto->direccion->direccion = $request->direccion;
        $almacen->sujeto->direccion->poblacion = $request->poblacion;
        $almacen->sujeto->direccion->codigoPostal = $request->codigoPostal;
        $almacen->sujeto->direccion->provincia = $request->provincia;
        $almacen->sujeto->direccion->pais = $request->pais;
 
        $almacen->sujeto->nombre = $request->nombre;
        $almacen->sujeto->primerApellido = $request->primerApellido;
        $almacen->sujeto->segundoApellido = $request->segundoApellido;
        $almacen->sujeto->nif = $request->nif;
        $almacen->sujeto->email = $request->email;
        $almacen->sujeto->telefono = $request->telefono;
        $almacen->sujeto->personaContacto = $request->personaContacto;
        $almacen->sujeto->paginaWeb = $request->paginaWeb; 

        $almacen->codigo = $request->codigo;
 
        $almacen->update(); 
        $almacen->geolocalizacion->update();
        $almacen->sujeto->update();
        $almacen->sujeto->direccion->update();

        return redirect()->route('almacenes.index')->with('status', 'El almacen fue actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Almacen $almacen)
    {        
        $this->authorize('modificarPanelAlmacenes', $almacen);

        $puedeBorrarse = Almacen::whereRaw('ID in (select distinct almacen_id from movimientosalmacenes
                                                    union all 
                                                    select distinct almacenDestinoCompra_id  from pedidoscompras)')
                                    ->where('id', '=', $almacen->id)  
                                    ->get()
                                    ->first(); 
        if($puedeBorrarse !== null)
            return redirect()->route('almacenes.show', $almacen)->with('status', 'El almacen no puede eliminarse. Está siendo utilizado en algún documento');

        $almacen->delete(); 
        return redirect()->route('almacenes.index')->with('status', 'El almacen fue eliminado con éxito');
    }




}
