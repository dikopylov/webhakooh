<?php

namespace App\Http\Middleware;

use \Illuminate\Http\Request;
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
    public function handle(Request $request, Closure $next)
    {
        if ($request['invitation-key'] !== null &&
            $this->invitationKeyRepository->getIdByCode($request['invitation-key']) !== null)
        {
            return $next($request);
        }
        else
        {
            return redirect('invitation-key');
        }
    }
}
