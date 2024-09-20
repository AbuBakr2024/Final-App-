<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
class roleone
{



    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->rule == 1){
            return $next($request);
        }else{
            return redirect(route('view.404'));
        }
    }
}


