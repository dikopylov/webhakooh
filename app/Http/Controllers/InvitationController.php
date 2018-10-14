<?php


namespace App\Http\Controllers;

use App;
use App\Http\Models\InvitationKey\InvitationKeyRepository;
use Illuminate\Http\Request;
use Mockery\Generator\Method;
use App\Http\AuthSession;

class InvitationController extends Controller
{
    private $invitationKeyRepository;

    public function __construct(InvitationKeyRepository $invitationKeyRepository)
    {
        $this->invitationKeyRepository = $invitationKeyRepository;
    }


    /**
     * @return App\Http\Models\InvitationKey\InvitationKey|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    private function getKey()
    {
        if ($this->invitationKeyRepository->getUnusedKey() == null)
        {
            $invitationKey = $this->invitationKeyRepository->getUnusedKey();
        }
        else
        {
            $invitationKey = $this->createKey();
        }

        return $invitationKey;
    }

    /**
     * @return App\Http\Models\InvitationKey\InvitationKey|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function createKey()
    {
        if (\Auth::check() && \Auth::user()->hasRole(App\Http\Models\Role\RoleType::ADMINISTRATOR)) {
            $invitationKey = $this->invitationKeyRepository->createKey();

            if (\Request::isMethod('POST')) {
                return $this->refreshInvitationKey($invitationKey->key);
            } else {
                return $invitationKey;
            }
        } else {
            return redirect('home');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function showInvitationKeyForm()
    {
        if (\Auth::check()) {
            if (\Auth::user()->hasRole(App\Http\Models\Role\RoleType::ADMINISTRATOR)) {
                $invitationKey = $this->getKey();
                return view('users.generate-key', ['invitationKey' => $invitationKey['key'], 'user' => \Auth::user()]);
            } else {
                return redirect('home');
            }
        } else {
            return view('auth.invitation-key');
        }
    }

    /**
     * @param $invitationKey
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function refreshInvitationKey($invitationKey)
    {
        return view('users.generate-key', ['invitationKey' => $invitationKey, 'user' => \Auth::user()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verify(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'invitation-key' => 'required|string|regex:/[A-Za-z0-9]{18}/'
        ]);

        if ($validator->fails())
        {
            return redirect('invitation-key');
        }
        else
        {
            return redirect()->route('register', ['invitation-key' => $request['invitation-key']]);
        }
    }
}