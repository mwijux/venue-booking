<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return $next($request);
        }

        // Kama ni guest na bado haja-approve
        if (auth()->user()->role === 'guest' && auth()->user()->status === 'pending') {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login')
                ->with('status', 'Your account is waiting for admin approval. Please try again later.');
        }

        return $next($request);
    }
}
