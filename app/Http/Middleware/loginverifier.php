<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class loginverifier
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

        if(session()->get('admin') == 1){
            return redirect('/roles');
        }
        elseif (session()->get('user') == 1) {
             return redirect('/usermanagement');
        }

        return $next($request);
    }
}
