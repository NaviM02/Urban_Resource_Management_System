<?php

namespace App\Infrastructure\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LoadUserRelations
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            Auth::user()->loadMissing('role');
        }

        return $next($request);
    }
}
