<?php

namespace App\Providers;

use App\Almacen;
use App\PedidoCompra;
use App\Policies\AlmacenPolicy;
use App\Policies\PedidoPolicy;
use App\Policies\ProductoPolicy;
use App\Policies\ProveedorPolicy;
use App\Policies\RecepcionPolicy;
use App\Policies\StockPolicy;
use App\Policies\UsuarioPolicy;
use App\Proveedor;
use App\Recepcion;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        PedidoCompra::class => PedidoPolicy::class,
        Recepcion::class => RecepcionPolicy::class,
        Stock::class => StockPolicy::class,
        Producto::class => ProductoPolicy::class,
        Proveedor::class => ProveedorPolicy::class,
        Almacen::class => AlmacenPolicy::class,
        User::class => UsuarioPolicy::class,
        
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
 
        //
    }
}
