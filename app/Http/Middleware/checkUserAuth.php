<?php

namespace App\Http\Middleware;

use Closure;

class checkUserAuth
{
    public function handle($request, Closure $next)
    {
        return !auth()->check() ? redirect()->to('/')->with('error', trans('messages.messages.Plz_Login_First')) : $next($request);
    }
}
