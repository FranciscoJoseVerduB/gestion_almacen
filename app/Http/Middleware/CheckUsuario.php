<?php

namespace App\Http\Middleware;

use Closure;

class CheckUsuario
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
        if(!(bool)$request->user()->rol->permisosRol->verPanelUsuarios)
            abort('403', 'No tiene autorización para acceder a esta sección');

        return $next($request);
    }
}
