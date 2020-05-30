<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;
use App\User;
use App\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{ 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('usuarios.index',['usuarios' => User::latest()->paginate(5)]); 
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
        $usuario->delete(); 
        return redirect()->route('usuarios.index')->with('status', 'El usuario fue eliminado con éxito');     
    }
}
