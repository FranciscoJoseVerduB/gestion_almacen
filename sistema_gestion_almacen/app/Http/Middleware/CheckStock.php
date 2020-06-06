<?php

namespace App\Http\Middleware;

use Closure;

class CheckStock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!(bool)$request->user()->rol->permisosRol->verPanelStock)
            abort('403', 'No tiene autorización para acceder a esta sección');

        return $next($request);
    }
}
