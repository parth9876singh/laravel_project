<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->role !== $role) {
            return redirect('/dashboard')->with('error', 'Access denied. This section is for ' . $role . 's only.');
        }

        return $next($request);
    }
}
