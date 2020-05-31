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
    public function __construct()
    {
        $this->middleware(CheckUsuario::class);
    }
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usuarios.roles.index',['roles' => Rol::latest()->paginate(5)]);
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
        try{
            DB::beginTransaction();

            $permisosRol = new PermisosRol([
                'permisoAdministrador' => $request->permisoAdministrador? true: false,
                'modificarDatosMaestros' => $request->modificarDatosMaestros? true: false,
                'verPanelRecursos' => $request->verPanelRecursos? true: false,
                'verPanelUsuarios' => $request->verPanelUsuarios? true: false,
                'verPanelPedidos' => $request->verPanelPedidos? true: false,
                'verPanelRecepciones' => $request->verPanelRecepciones? true: false,
                'verPanelStock' => $request->verPanelStock? true: false,
                'verPanelAlmacenes' => $request->verPanelAlmacenes? true: false,
                'verPanelProveedores' => $request->verPanelProveedoress? true: false,            
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


        $rol->codigo = $request->codigo;
        $rol->nombre = $request->nombre;
        $rol->permisosRol->permisoAdministrador  = $request->permisoAdministrador? 1: 0;
        $rol->permisosRol->modificarDatosMaestros  = $request->modificarDatosMaestros? 1: 0;
        $rol->permisosRol->verPanelRecursos  = $request->verPanelRecursos? 1: 0;
        $rol->permisosRol->verPanelUsuarios  = $request->verPanelUsuarios? 1: 0;
        $rol->permisosRol->verPanelPedidos  = $request->verPanelPedidos? 1: 0;
        $rol->permisosRol->verPanelRecepciones  = $request->verPanelRecepciones? 1: 0;
        $rol->permisosRol->verPanelStock  = $request->verPanelStock? 1: 0;
        $rol->permisosRol->verPanelAlmacenes  = $request->verPanelAlmacenes? 1: 0;
        $rol->permisosRol->verPanelProveedores  = $request->verPanelProveedores? 1: 0;
        
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
        $rol->delete(); 
        return redirect()->route('roles.index')->with('status', 'El rol fue eliminado con éxito');     
    }
}
