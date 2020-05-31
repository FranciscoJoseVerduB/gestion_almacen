<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductoPolicy
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
    public function verPanelProductos(User $user){
        return  (bool)$user->rol->permisosRol->verPanelProductos;
    }

    public function modificarPanelProductos(User $user){
        return  (bool)$user->rol->permisosRol->modificarPanelProductos;
    }
}
