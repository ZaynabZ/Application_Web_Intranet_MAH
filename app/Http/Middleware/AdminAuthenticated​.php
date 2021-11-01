<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Session;

class AdminAuthenticated​
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
        if(Auth::check())
        {
            /**  S'il ne s'agit pas d'un admin,
            * l'utilisateur est redérigé vers home
            */
            if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
            {
                return $next($request);
                
            }
            return redirect('home');
        }
        
    }
}
