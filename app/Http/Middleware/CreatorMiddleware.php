<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreatorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Perform middleware actions here
    // For example, check if the user has the 'creator' role
        // You can use the Spatie Laravel-Permission package here

        if (auth()->check()) {
            // User is logged in
            if (!auth()->user()->hasRole('creator')) {
                abort(403, 'Unauthorized.'); // User does not have the 'consumer' role
            } 
        } else {
            abort(401, 'Unauthenticated.'); // User is not logged in
        }

        return $next($request);
    }
}
