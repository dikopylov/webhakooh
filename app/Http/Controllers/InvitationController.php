<?php


namespace App\Http\Controllers;

use App;
use App\InvitationKey;
use Illuminate\Http\Request;

class InvitationController extends Controller
{

    public function __construct()
    {
        $this->middleware('check.admin');
    }

    private $checkKey;

    /**
     * @return bool
     */
    public function getCheckKey() : bool
    {
        return $this->checkKey;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function showInvitationKeyForm()
    {
        if(\Auth::check())
        {
            $invitationKey = $this->getKey();
            return view('administration.generate-key', ['invitationKey' => $invitationKey['key']]);
        }
        else
        {
            return view('auth.invitation-key');
        }
    }

    /**
     * @return InvitationKey
     * @throws \Exception
     */
    protected function createKey()
    {
        $invitationKey = new InvitationKey();

        $invitationKey->key = bin2hex(random_bytes(16));
        $invitationKey->created_by_user_id = \Auth::id();

        $invitationKey->save();

        return $invitationKey;
    }

    /**
     * @return InvitationKey
     * @throws \Exception
     */
    protected function getKey()
    {
        try
        {
            $invitationKey = InvitationKey::whereNull('is_used')->firstOrFail();
        }
        catch (\Exception $modelNotFoundException) // нужно поймать именно это исключение Illuminate\Database\Eloquent\ModelNotFoundException
        {
            $invitationKey = $this->createKey();
        }

        return $invitationKey;
    }

    /**
     * @param string $key
     * @return InvitationKey
     */
    public static function getInvitationByCode($key) {
        return InvitationKey::where('key', $key)->whereNull('is_used')->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getInvitationIdByCode($id) {
        return InvitationKey::find($id)->whereNull('is_used')->first()['id'];
    }

    protected function validateKey(array $data)
    {
        return Validator::make($data, [
            'invitation-key' => 'required|string|regex:/[A-Za-z0-9]{18}/'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function checkKey(Request $request)
    {

        $requestData = $request->All();

        if($requestData != NULL &&
            self::getInvitationByCode($requestData['invitation-key']) != NULL)
        {
//            $invitationKey['is_used'] = 1;

            $request->session()->put('invitation_key', $requestData['invitation-key']);
            $request->session()->put('id', self::getInvitationIdByCode($requestData['invitation-key']));
            return view('auth.register');
        }
        else
        {
            return view('auth.invitation-key');
        }
    }

    public static function setKeyIsUsed($key)
    {
        if($invitationKey = InvitationKey::where('key', $key)->first())
        {
            $invitationKey->is_used = 1;
            $invitationKey->save();

            return true;
        }
        else
        {
            return false;
        }

    }
}