<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = auth()->user();

        // Jika tidak login
        if (!$user) {
            return redirect()->route('login');
        }


        // Cek apakah role cocok
        if (!$user->hasRole($role)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
