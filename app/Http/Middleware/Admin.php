<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
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
    public function handle(Request $request, Closure $next): Response
    {

        if (!auth()->user()) {
            return response()->json([
                'title' => 'Unauthorized',
                'message' => 'Please login first'
            ], 401);
        }

        if (!auth()->user()->isAdmin()) {
            return response()->json([
                'title' => 'Forbidden',
                'message' => 'Contact your administrator to get access to this resource'
            ], 403);
        }

        return $next($request);
    }
}
