<?php

namespace App\Policies;

use App\User;
use App\PedidoCompra;
use Illuminate\Auth\Access\HandlesAuthorization;

class PedidoPolicy
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
    public function modificarPanelPedidos(User $user){
        return (bool) $user->rol->permisosRol->modificarPanelPedidos;
    } 

}
