<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        #var_dump(session()->get('utype'));
        #return $next($request);
        if (session()->get('utype') === 'ADM') return $next($request);
        else {
            session()->flash('status', 'Vajalik admini õigustega sisse logida');
            return redirect()->route('login');
        }
    }
}
