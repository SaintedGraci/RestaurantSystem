<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Check if the user is logged in and has the correct role
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Redirect back if the role doesn't match
        return redirect('/');
    }
}
