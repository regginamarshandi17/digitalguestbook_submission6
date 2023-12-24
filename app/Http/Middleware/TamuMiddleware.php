<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TamuMiddleware
{
    public function handle($request, Closure $next)
    {
        
        if (Auth::check() && Auth::user()->role === 'tamu') {
            return $next($request);
        }

        // Redirect atau lakukan sesuatu jika pengguna bukan admin
        return redirect('/')->with('error', 'Unauthorized access.');
    }
}
