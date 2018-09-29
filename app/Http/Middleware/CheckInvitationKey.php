<?php

namespace App\Http\Middleware;

use App\Http\Controllers\InvitationController;
use Closure;

class CheckInvitationKey
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
        if (session('invitation-key') !== NULL &&
            InvitationController::getInvitationIdByCode(session('invitation-key')) != NULL)
        {
            return $next($request);
        }
        else
        {
            return redirect('invitation-key');
        }
    }
}
