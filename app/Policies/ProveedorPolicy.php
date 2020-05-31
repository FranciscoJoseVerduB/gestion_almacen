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
    public function modificarPanelProveedores(User $user){
        return (bool) $user->rol->permisosRol->modificarPanelProveedores;
    }

}
