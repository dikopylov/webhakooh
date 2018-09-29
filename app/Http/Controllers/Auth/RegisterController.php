<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\InvitationController;
use App\InvitationKey;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Psr\Log\NullLogger;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest', 'check.key']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'first_name' => 'required|string|max:255',
            'patronymic' => 'string|max:255',
            'second_name' => 'required|string|max:255',
            'phone' => 'required|regex:/[0-9]{5,11}/|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        if(InvitationController::getInvitationIdByCode(session('invitation-key')) != NULL &&
            InvitationController::setKeyIsUsed(session('invitation-key')))
        {
            $user = User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'first_name' => $data['first_name'],
            'patronymic' => $data['patronymic'],
            'second_name' => $data['second_name'],
            'phone' => $data['phone'],
            'invitation_key' => session('invitation-key'),
        ]);
            $user->assignRole('Менеджер');
            return $user;
        }
            return NULL;

    }
}
