<?php

namespace App\Http\Middleware;

use Velocix\Http\Middleware;
use Velocix\Http\Request;
use Velocix\Auth\Auth;

class GuestMiddleware extends Middleware
{
    public function handle(Request $request, $next)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}