<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\InvitationController;
use App\Http\Models\InvitationKey\InvitationKeyRepository;
use App\Http\Models\User\User;
use App\Http\Controllers\Controller;
use App\Http\Models\User\UserRepository;
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

    private $invitationKeyRepository;

    private $userRepository;

    /**
     * RegisterController constructor.
     * @param InvitationKeyRepository $invitationKeyRepository
     * @param UserRepository $userRepository
     */
    public function __construct(InvitationKeyRepository $invitationKeyRepository, UserRepository $userRepository)
    {
        $this->invitationKeyRepository = $invitationKeyRepository;
        $this->userRepository = $userRepository;
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
        if($this->invitationKeyRepository->getIdByCode($data['invitation-key']) !== null)
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
        else {
            return redirect('invitation-key');
        }
    }

    /**
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        return $this->userRepository->create($data);
    }
}
