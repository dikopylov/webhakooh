<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\User\User;
use Spatie\Permission\Traits\HasRoles;
class CheckAdmin
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
        /**
         * @TODO сделать норм обработчик
         */
        if (User::all()->count() > 1) {
            if (Auth::user()->hasRole('Менеджер'))
            {
                abort('401', 'NO ACCESS');
            }
        }

        return $next($request);
    }
}