<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecursoPolicy
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
    public function verPanelRecursos(User $user){
        return (bool) $user->rol->permisosRol->verPanelRecursos;
    }
    public function escribirPanelRecursos(User $user){
        return (bool) $user->rol->permisosRol->verPanelRecursos && (bool)$user->rol->permisosRol->modificarDatosMaestros;
    }

}
