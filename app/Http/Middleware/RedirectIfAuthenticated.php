<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

    public function handle(Request $request, Closure $next)
    {
            if (Auth::guard('web')->check()) {
                return redirect(RouteServiceProvider::HOME);
            }

            if (Auth::guard('admins')->check()) {
                return redirect(RouteServiceProvider::admin);
            }

            return $next($request);
}
}
