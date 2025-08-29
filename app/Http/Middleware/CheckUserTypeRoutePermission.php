<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserTypeRoutePermission
{
    
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user || !$user->typeUser) {
            abort(403, 'Usuário sem tipo definido.');
        }

        $routeName = $request->route()->getName();

        $accessRoutes = $user->typeUser->access_routes;
        if (is_string($accessRoutes)) {
            $accessRoutes = json_decode($accessRoutes, true);
        }
        $accessRoutes = $accessRoutes ?? [];

        if (!in_array($routeName, $accessRoutes)) {
            abort(403, 'Acesso não autorizado para este tipo de usuário.');
        }

        return $next($request);
    }
} 