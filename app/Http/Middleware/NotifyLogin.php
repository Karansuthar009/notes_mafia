<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class NotifyLogin
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            Session::put('login_notification', true);
        }
        return $next($request);
    }
}
