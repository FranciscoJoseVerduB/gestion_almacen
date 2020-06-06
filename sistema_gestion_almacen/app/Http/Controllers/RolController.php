<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUsuario;
use App\Http\Requests\SaveRolRequest;
use App\PermisosRol;
use App\Rol; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    private $numeroLinks = 15;

    public function __construct()
    { 
        $this->middleware('auth'); 
        $this->middleware(CheckUsuario::class);
    }
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $nombre = $request->get('buscarpor');

        return view('usuarios.roles.index',['roles' => 
                    Rol::whereRaw(" UPPER(roles.nombre) like UPPER('%".$nombre."%') OR
                                            UPPER(roles.codigo) like UPPER('%".$nombre."%')")
                                ->orderBy('roles.created_at', 'DESC')
                                ->paginate($this->numeroLinks)] );    
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.roles.create', [
            'rol'=> new Rol,
            'permisosRol' => new PermisosRol
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRolRequest $request)
    {
        $this->authorize('modificarPanelUsuarios', new Rol);

        try{
            DB::beginTransaction();

            $permisosRol = new PermisosRol([
                'permisoAdministrador' => $request->permisoAdministrador? true: false,
                'verPanelRecursos' => $request->verPanelRecursos? true: false,
                
                'verPanelProductos' => $request->verPanelProductos? true: false,
                'modificarPanelProductos' => $request->modificarPanelProductos? true: false,

                'verPanelUsuarios' => $request->verPanelUsuarios? true: false,
                'modificarPanelUsuarios' => $request->modificarPanelUsuarios? true: false,

                'verPanelPedidos' => $request->verPanelPedidos? true: false,
                'modificarPanelPedidos' => $request->modificarPanelPedidos? true: false,
                
                'verPanelRecepciones' => $request->verPanelRecepciones? true: false,
                'modificarPanelRecepciones' => $request->modificarPanelRecepciones? true: false,

                'verPanelStock' => $request->verPanelStock? true: false,
                'modificarPanelStock' => $request->modificarPanelStock? true: false,
                
                'verPanelAlmacenes' => $request->verPanelAlmacenes? true: false,
                'modificarPanelAlmacenes' => $request->modificarPanelAlmacenes? true: false,

                'verPanelProveedores' => $request->verPanelProveedoress? true: false,            
                'modificarPanelProveedores' => $request->modificarPanelProveedoress? true: false, 
            ]);     
            $permisosRol->save();

        

            $rol = new Rol([
                'codigo' => $request->codigo,
                'nombre' =>  $request->nombre,
                'permisosrole_id' => $permisosRol->id 
            ]); 
            $rol->save(); 

            
            DB::commit(); 
            return redirect()->route('roles.index')->with('status', 'El rol ha sido creado con éxito');
        }catch(\Exception $e){
            DB::rollback(); 
            return redirect()->route('roles.index')->with('status', 'Ha ocurrido un error al crear el rol'. 'Mensaje de error: '.$e);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $rol)
    {
        return view('usuarios.roles.show', [
            'rol' => $rol, 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function edit(Rol $rol)
    {
        return view('usuarios.roles.edit', [
            'rol' => $rol, 
            'permisosRol' => $rol->permisosRol
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRolRequest $request, Rol $rol)
    { 
        $this->authorize('modificarPanelUsuarios', $rol);

        $rol->codigo = $request->codigo;
        $rol->nombre = $request->nombre;
        $rol->permisosRol->permisoAdministrador = $request->permisoAdministrador? 1: 0;
        $rol->permisosRol->verPanelRecursos  = $request->verPanelRecursos? 1: 0;
         
        $rol->permisosRol->verPanelProductos = $request->verPanelProductos? 1: 0; 
        $rol->permisosRol->modificarPanelProductos = $request->modificarPanelProductos? 1: 0; 
         
        $rol->permisosRol->verPanelUsuarios  = $request->verPanelUsuarios? 1: 0;
        $rol->permisosRol->modificarPanelUsuarios  = $request->modificarPanelUsuarios? 1: 0;

        $rol->permisosRol->verPanelPedidos  = $request->verPanelPedidos? 1: 0;
        $rol->permisosRol->modificarPanelPedidos  = $request->modificarPanelPedidos? 1: 0;
        
        $rol->permisosRol->verPanelRecepciones  = $request->verPanelRecepciones? 1: 0;
        $rol->permisosRol->modificarPanelRecepciones  = $request->modificarPanelRecepciones? 1: 0;

        $rol->permisosRol->verPanelStock  = $request->verPanelStock? 1: 0;
        $rol->permisosRol->modificarPanelStock  = $request->modificarPanelStock? 1: 0;

        $rol->permisosRol->verPanelAlmacenes  = $request->verPanelAlmacenes? 1: 0;
        $rol->permisosRol->modificarPanelAlmacenes  = $request->modificarPanelAlmacenes? 1: 0;
        
        $rol->permisosRol->verPanelProveedores  = $request->verPanelProveedores? 1: 0;
        $rol->permisosRol->modificarPanelProveedores  = $request->modificarPanelProveedores? 1: 0;
 
        $rol->update();  
        $rol->permisosRol->update();

 
        return redirect()->route('roles.index')->with('status', 'El rol fue actualizado con éxito'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rol $rol)
    {
        $this->authorize('modificarPanelUsuarios', $rol);

        $puedeBorrarse = Rol::whereRaw('id in (select distinct role_id from users )')
                                    ->where('id', '=', $rol->id)  
                                    ->get()
                                    ->first(); 
        if($puedeBorrarse !== null)
            return redirect()->route('roles.show', $rol)->with('status', 'El rol no puede eliminarse. Está siendo utilizado en algún usuario');


        $rol->delete(); 
        return redirect()->route('roles.index')->with('status', 'El rol fue eliminado con éxito');     
    }
}
