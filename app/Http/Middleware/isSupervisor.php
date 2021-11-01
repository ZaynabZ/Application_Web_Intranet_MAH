<?php

namespace App\Http\Middleware;

use Closure;

class isSupervisor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->isSupervisor()){
            return $next($request);
        }
        return redirect('home');

    }
}
