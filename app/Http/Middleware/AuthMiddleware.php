<?php

namespace App\Http\Middleware;

use Velocix\Http\Middleware;
use Velocix\Http\Request;
use Velocix\Auth\Auth;

class AuthMiddleware extends Middleware
{
    public function handle(Request $request, $next)
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return json(['error' => 'Unauthenticated'], 401);
            }

            return redirect('/login');
        }

        return $next($request);
    }
}