<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
{
    if (auth($guard)->check() && auth($guard)->user()->role == 'admin') {
        return $next($request);
    }
    abort(403, 'Akses Anda ditolak, Anda bukan admin');
}

}
