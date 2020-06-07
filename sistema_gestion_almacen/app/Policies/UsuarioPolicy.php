<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsuarioPolicy
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
    
    public function verPanelUsuarios(User $user){
        return (
                 (bool) $user->rol->permisosRol->verPanelUsuarios &&
                 (bool) $user->rol->permisosRol->permisoAdministrador
        );
    }
    
    public function modificarPanelUsuarios(User $user){
        return (
                (bool) $user->rol->permisosRol->modificarPanelUsuarios &&
                (bool) $user->rol->permisosRol->permisoAdministrador
        );
    }
}
