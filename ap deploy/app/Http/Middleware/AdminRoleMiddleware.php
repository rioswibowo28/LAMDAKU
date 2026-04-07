<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if user is authenticated
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // If no specific roles are required, just check authentication
        if (empty($roles)) {
            return $next($request);
        }

        // Check if user has required role
        $userRole = session('admin_role');
        
        if (!in_array($userRole, $roles)) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
