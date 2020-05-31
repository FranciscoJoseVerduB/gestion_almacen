<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProcesoPolicy
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

    public function verPanelProcesos(User $user){
        return (
                    (bool) $user->rol->permisosRol->verPanelPedidos ||
                    (bool) $user->rol->permisosRol->verPanelRecepciones ||
                    (bool) $user->rol->permisosRol->verPanelStock 
                );
    }
}
