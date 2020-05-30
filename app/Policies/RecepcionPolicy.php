<?php

namespace App\Policies;

use App\Recepcion;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecepcionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
         
    }

    public function verPanelRecepciones(User $user){
        return (bool) $user->rol->permisosRol->verPanelRecepciones;
    }
    public function escribirPanelRecepciones(User $user){
        return (bool) $user->rol->permisosRol->verPanelRecepciones && (bool)$user->rol->permisosRol->modificarDatosMaestros;
    }
}
