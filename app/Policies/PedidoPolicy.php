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
    public function view(User $user){ 
        return true;
    }

    public function verPanelPedidos(User $user){ 
        return (bool) $user->rol->permisosRol->verPanelPedidos;
    }
    public function escribirPanelPedidos(User $user){
        return (bool) $user->rol->permisosRol->verPanelPedidos && (bool)$user->rol->permisosRol->modificarDatosMaestros;
    } 

}
