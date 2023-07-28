<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConsumerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            // User is logged in
            if (!auth()->user()->hasRole('consumer')) {
                abort(403, 'Unauthorized.'); // User does not have the 'consumer' role
            } 
        } else {
            abort(401, 'Unauthenticated.'); // User is not logged in
        }

        return $next($request);
    }
}
