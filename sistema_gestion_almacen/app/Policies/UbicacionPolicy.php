<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UbicacionPolicy
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

    public function verPanelUbicaciones(User $user){
        return  (
                    (bool) $user->rol->permisosRol->verPanelAlmacenes || 
                    (bool) $user->rol->permisosRol->verPanelProveedores
                );  
    }

}
