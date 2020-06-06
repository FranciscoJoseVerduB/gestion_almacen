<?php

namespace App\Http\Controllers;

use App\Direccion;
use App\Http\Middleware\CheckProveedor;
use App\Sujeto;
use App\Http\Requests\SaveProveedorRequest;
use App\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    private $numeroLinks = 15;



    public function __construct()
    { 
        $this->middleware('auth'); 
        $this->middleware(CheckProveedor::class);
    }
       
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    { 
        $nombre = $request->get('buscarpor');

        return view('proveedores.index',['proveedores' => 
                Proveedor::join('sujetos', 'sujeto_id', '=', 'sujetos.id') 
                        ->whereRaw(" UPPER(sujetos.nombre) like UPPER('%".$nombre."%') OR 
                                        UPPER(proveedores.codigo) like UPPER('%".$nombre."%')")
                        ->select('proveedores.*')
                        ->orderBy('proveedores.created_at', 'DESC')
                        ->paginate($this->numeroLinks)] );
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        return view('proveedores.create', [
            'proveedor'=> new Proveedor(), 
            'sujeto' => new Sujeto(),
            'direccion' => new Direccion()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveProveedorRequest $request)
    { 
        $this->authorize('modificarPanelProveedores', new Proveedor);


        try{
            DB::beginTransaction();

            $direccion = new Direccion([
                'direccion' => $request['direccion'],
                'poblacion' => $request['poblacion'],
                'codigoPostal' => $request['codigoPostal'],
                'provincia' => $request['provincia'],
                'pais' => $request['pais']
            ]);  $direccion->save();

 
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

            $proveedor = new Proveedor([
                'codigo' => $request['codigo'],
                'sujeto_id' => $sujeto->id
            ]); $proveedor->save();
        
            DB::commit();
            
            return redirect()->route('proveedores.index')->with('status', 'El proveedor fue creado con éxito');
        }catch(\Exception $e){
            DB::rollback(); 
            return redirect()->route('proveedores.index')->with('status', 'Ha ocurrido un error al crear el proveedor'. 'Mensaje de error: '.$e);
        }


        // Proveedor::create($request->validated()); 
        // return redirect()->route('proveedores.index')->with('status', 'El proveedor fue creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    { 
        return view('proveedores.show', [
            'proveedor' => $proveedor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    { 
        return view('proveedores.edit', [
            'proveedor' =>$proveedor,  
            'sujeto' => $proveedor->sujeto,
            'direccion' => $proveedor->sujeto->direccion
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(SaveProveedorRequest $request, Proveedor $proveedor)
    {   
        $this->authorize('modificarPanelProveedores', $proveedor);


        $proveedor->sujeto->direccion->direccion = $request->direccion;
        $proveedor->sujeto->direccion->poblacion = $request->poblacion;
        $proveedor->sujeto->direccion->codigoPostal = $request->codigoPostal;
        $proveedor->sujeto->direccion->provincia = $request->provincia;
        $proveedor->sujeto->direccion->pais = $request->pais;
 
        $proveedor->sujeto->nombre = $request->nombre;
        $proveedor->sujeto->primerApellido = $request->primerApellido;
        $proveedor->sujeto->segundoApellido = $request->segundoApellido;
        $proveedor->sujeto->nif = $request->nif;
        $proveedor->sujeto->email = $request->email;
        $proveedor->sujeto->telefono = $request->telefono;
        $proveedor->sujeto->personaContacto = $request->personaContacto;
        $proveedor->sujeto->paginaWeb = $request->paginaWeb; 

        $proveedor->codigo = $request->codigo;
 
        $proveedor->update(); 
        $proveedor->sujeto->update();
        $proveedor->sujeto->direccion->update();

        return redirect()->route('proveedores.index')->with('status', 'El proveedor fue actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        $this->authorize('modificarPanelProveedores', $proveedor);


        $puedeBorrarse = Proveedor::whereRaw('ID in (select distinct proveedor_id from pedidoscompras
                                                    union all 
                                                    select distinct proveedor_id  from recepciones)')
                                    ->where('id', '=', $proveedor->id)  
                                    ->get()
                                    ->first(); 
        if($puedeBorrarse !== null)
            return redirect()->route('proveedores.show', $proveedor)->with('status', 'El proveedor no puede eliminarse. Está siendo utilizado en algún documento');



        $proveedor->delete(); 
        return redirect()->route('proveedores.index')->with('status', 'El proveedor fue eliminado con éxito');
    }
}
