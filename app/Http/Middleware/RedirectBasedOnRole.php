<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            return match (auth()->user()->role) {
                'superadmin' => redirect()->route('superadmin.dashboard.index'),
                'adminwisata' => redirect()->route('admin-wisata.wisata.index'),
                default => redirect()->route('landing.index'),
            };
        }

        return $next($request);
    }
}
