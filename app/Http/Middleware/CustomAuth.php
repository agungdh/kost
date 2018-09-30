<?php

namespace App\Http\Middleware;

use Closure;

class CustomAuth
{
    public function handle($request, Closure $next, ...$accepts)
    {
        if (!in_array(session('level'), $accepts)) {
            return redirect(route('login'));
        } else {
            return $next($request);
        }
    }
}
