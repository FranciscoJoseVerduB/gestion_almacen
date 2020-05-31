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
    public function modificarPanelUsuarios(User $user){
        return (bool) $user->rol->permisosRol->modificarPanelUsuarios;
    }
}
