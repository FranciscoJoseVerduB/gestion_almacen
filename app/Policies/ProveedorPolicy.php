<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProveedorPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    } 
    public function verPanelProveedores(User $user){
        return (bool) $user->rol->permisosRol->verPanelProveedores;
    }
    public function escribirPanelProveedores(User $user){
        return (bool) $user->rol->permisosRol->verPanelProveedores && (bool)$user->rol->permisosRol->modificarDatosMaestros;
    }

}
