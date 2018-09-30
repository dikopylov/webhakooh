<?php

namespace App\Http\Middleware;

use App\Http\Controllers\InvitationController;
use Closure;
use App\Http\Models\InvitationKey\InvitationKeyRepository;

class CheckInvitationKey
{

    private $invitationKeyRepository;

    public function __construct(InvitationKeyRepository $invitationKeyRepository)
    {
        $this->invitationKeyRepository = $invitationKeyRepository;
    }

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
            $this->invitationKeyRepository->getIdByCode(session('invitation-key')) != NULL)
        {
            return $next($request);
        }
        else
        {
            return redirect('invitation-key');
        }
    }
}
