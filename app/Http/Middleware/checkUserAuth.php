<?php

namespace App\Http\Middleware;

use Closure;

class checkUserAuth
{
    public function handle($request, Closure $next)
    {
        return !auth()->check() ? redirect()->to('/') : $next($request);
    }
}
