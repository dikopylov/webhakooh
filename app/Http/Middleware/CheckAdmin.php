<?php

namespace App\Http\Middleware;

use App\Http\Models\Role\RoleType;
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
            if (Auth::user()->hasRole(RoleType::MANAGER))
            {
                abort('401', 'NO ACCESS');
            }
        }

        return $next($request);
    }
}