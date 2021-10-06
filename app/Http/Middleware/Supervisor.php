<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Supervisor
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

        if(!Auth::check()){
            return redirect()->route('login');
        }

        $userRoles = Auth::user()->roles->pluck('name');
        
        if($userRoles->contains('admin')){
            return redirect()->route('admin');
        }

        if($userRoles->contains('supervisor')){
            return $next($request);
        }

        if($userRoles->contains('student')){
            return redirect()->route('student');
        }
    }
}
