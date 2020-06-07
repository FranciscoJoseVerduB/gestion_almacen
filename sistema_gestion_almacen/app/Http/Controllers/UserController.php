<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUsuario;
use App\Http\Requests\SaveUserRequest;
use App\User;
use App\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

        return view('usuarios.index',['usuarios' => 
                    User::whereRaw(" UPPER(users.nombre) like UPPER('%".$nombre."%') OR
                                            UPPER(users.codigo) like UPPER('%".$nombre."%') OR 
                                                UPPER(users.email) like UPPER('%".$nombre."%')")
                                ->orderBy('users.created_at', 'DESC')
                                ->paginate($this->numeroLinks)] );    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create', [
            'usuario'=> new User,
            'roles' => Rol::all()
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUserRequest $request)
    {
        $this->authorize('modificarPanelUsuarios',  User::class);

        $user = new User($request->validated());
        $user->password = Hash::make($request->password);
        $user->save(); 

        return redirect()->route('usuarios.index')->with('status', 'El usuario fue creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        return view('usuarios.show', [
            'usuario' => $usuario,
            'roles' => Rol::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        return view('usuarios.edit', [
            'usuario' =>$usuario,
            'roles' => Rol::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(SaveUserRequest $request, User $usuario)
    {
        $this->authorize('modificarPanelUsuarios', $usuario);
 
        //Si el usuario a modificar es administrador, no se podrá modificar
        if($usuario->codigo === "admin") 
            return redirect()->route('usuarios.index')->with('status', 'El usuario no se puede modificar. Es administrador'); 

        $usuario->update($request->validated());   
        return redirect()->route('usuarios.index')->with('status', 'El usuario fue actualizado con éxito'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $this->authorize('modificarPanelUsuarios', $usuario);

        //Si el usuario es el administrador, no se podrá modificar
        if($usuario->codigo === "admin") 
            return redirect()->route('usuarios.index')->with('status', 'El usuario no se puede eliminar. Es administrador'); 

        $usuario->delete(); 
        return redirect()->route('usuarios.index')->with('status', 'El usuario fue eliminado con éxito');     
    }
}
