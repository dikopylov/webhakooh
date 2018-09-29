<?php

namespace App\Http\Middleware;

use Closure;

class CheckDelete
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

        if(\Auth::check() && \Auth::user()->is_delete) {
            //\Auth::logout();
            abort('401', 'NO ACCESS');
        }
        return $next($request);
    }
}
