<?php


namespace App\Http\Controllers;

use App;
use App\InvitationKey;
use Mockery\Generator\Method;

class InvitationController extends Controller
{

    public function __construct()
    {
        $this->middleware('check.admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function showInvitationKeyForm()
    {
        $invitationKey = $this->getKey();
        return view('users.generate-key', ['invitationKey' => $invitationKey['key']]);
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
     * @return InvitationKey|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    protected function createKey()
    {
        $invitationKey = new InvitationKey();

        $invitationKey->key = bin2hex(random_bytes(16));
        $invitationKey->author_id = \Auth::id();

        $invitationKey->save();

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

        return InvitationKey::find($id)->where('is_used', false)->first()['id'];
    }

    protected function validateKey(array $data)
    {
        return Validator::make($data, [
            'invitation-key' => 'required|string|regex:/[A-Za-z0-9]{18}/'
        ]);
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