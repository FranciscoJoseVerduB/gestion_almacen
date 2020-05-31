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
 
    public function modificarPanelRecepciones(User $user){
        return (bool) $user->rol->permisosRol->modificarPanelRecepciones;
    }
}
