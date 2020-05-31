<?php

namespace App\Providers;

use App\Almacen;
use App\Familia;
use App\Impuesto;
use App\Marca;
use App\PedidoCompra;
use App\Policies\AlmacenPolicy;
use App\Policies\PedidoPolicy;
use App\Policies\ProductoPolicy;
use App\Policies\ProveedorPolicy;
use App\Policies\RecepcionPolicy;
use App\Policies\RecursoPolicy;
use App\Policies\StockPolicy;
use App\Policies\UsuarioPolicy;
use App\Proveedor;
use App\Recepcion;
use App\RegularizacionManual;
use App\Rol;
use App\Subfamilia;
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
        Proveedor::class => ProveedorPolicy::class,
        Almacen::class => AlmacenPolicy::class,

        PedidoCompra::class => PedidoPolicy::class,
        Recepcion::class => RecepcionPolicy::class,
        Stock::class => StockPolicy::class,
        RegularizacionManual::class => StockPolicy::class,

        // ClaseDesconocida::class => RecursoPolicy::class,
        User::class => UsuarioPolicy::class, 
        Rol::class => UsuarioPolicy::class, 

        Producto::class => ProductoPolicy::class,
        Marca::class => ProductoPolicy::class,
        Impuesto::class => ProductoPolicy::class,
        Familia::class => ProductoPolicy::class,
        Subfamilia::class => ProductoPolicy::class,

        
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
