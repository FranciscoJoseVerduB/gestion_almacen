<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StockPolicy
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
    public function verPanelStock(User $user){
        return (bool) $user->rol->permisosRol->verPanelStock;
    }
     
    public function modificarPanelStock(User $user){
        return (bool) $user->rol->permisosRol->modificarPanelStock;
    }

}
