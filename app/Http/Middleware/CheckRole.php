<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Kama user hajalogin
        if (!auth()->check()) {
            return redirect('login');
        }

        $userRole = auth()->user()->role;

        // Kama hakuna role iliyotajwa kwenye route, ruhusu tu
        if (empty($roles)) {
            return $next($request);
        }

        // Angalia kama role ya user ipo kwenye orodha
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Kama hana ruhusa
        abort(403, 'You do not have permission to access this page.');
    }
}
