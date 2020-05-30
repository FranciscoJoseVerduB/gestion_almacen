<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlmacenPolicy
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
    
    public function verPanelAlmacenes(User $user){
        return (bool) $user->rol->permisosRol->verPanelProverPanelAlmacenesveedores;
    }
    public function escribirPanelAlmacenes(User $user){
        return (bool) $user->rol->permisosRol->verPanelAlmacenes && (bool)$user->rol->permisosRol->modificarDatosMaestros;
    }

}
