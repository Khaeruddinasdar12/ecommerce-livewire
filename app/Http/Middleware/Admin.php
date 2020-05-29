<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        // return $next($request);
            if(auth()->user()->is_admin == 1) {
             return $next($request);
            }
            return redirect('home')->with('error','Kamu bukan admin');
    }
}
