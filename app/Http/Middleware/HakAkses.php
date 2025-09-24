<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class HakAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Allow full access for users explicitly marked as 'admin'
        if (Auth::check() && Auth::user()->level === 'admin') {
            return $next($request);
        }

        $route = Route::currentRouteName();
        if (!is_able($route)) {
            return abort('403');
        }
        
        return $next($request);
    }
}
