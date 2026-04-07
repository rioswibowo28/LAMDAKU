<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Simple session-based authentication for demo purposes
        // In production, you would use Laravel's built-in authentication
        if (!session('admin_authenticated')) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
