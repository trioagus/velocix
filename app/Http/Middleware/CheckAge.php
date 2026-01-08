<?php

namespace App\Http\Middleware;

use Velocix\Http\Middleware;
use Velocix\Http\Request;

class CheckAge extends Middleware
{
    public function handle(Request $request, $next)
    {
        // Middleware logic here
        
        return $next($request);
    }
}