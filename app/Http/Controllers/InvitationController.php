<?php


namespace App\Http\Controllers;

use App;
use App\Http\Models\InvitationKey\InvitationKeyRepository;
use Illuminate\Http\Request;
use Mockery\Generator\Method;

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
        if ($this->invitationKeyRepository->getUnusedKey() == NULL)
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
        $invitationKey = $this->invitationKeyRepository->createKey();

        if (\Request::isMethod('POST'))
        {
            return $this->showNewInvitationKeyForm($invitationKey->key);
        }
        else
        {
            return $invitationKey;
        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function showInvitationKeyForm()
    {
        if (\Auth::check())
        {
            $invitationKey = $this->getKey();
            return view('users.generate-key', ['invitationKey' => $invitationKey['key']]);
        }
        else
        {

            return view('auth.invitation-key');
        }

    }

    /**
     * @param $invitationKey
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNewInvitationKeyForm($invitationKey)
    {
        return view('users.generate-key', ['invitationKey' => $invitationKey]);
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

        if (!$validator->fails()) {
            return redirect('register')->with('invitation-key', $request['invitation-key']);
        }
        else
        {
            return redirect('invitation-key');
        }
    }
}