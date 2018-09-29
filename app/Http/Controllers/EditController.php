<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EditController extends Controller
{
    /**
     * EditController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProfileForm()
    {
        return view('administration.edit.profile');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPasswordForm()
    {
        return view('administration.edit.password');
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    protected function validateProfile(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'first_name' => 'required|string|max:255',
            'patronymic' => 'string|max:255',
            'second_name' => 'required|string|max:255',
            'phone' => 'required|regex:/[0-9]{5,11}/|unique:users',
        ]);
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    protected function validatePassword(array $data)
    {
        return Validator::make($data, [
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);
    }

    public function updateProfile(Request $request)
    {
        $requestData = $request->All();
        $validator = $this->validateProfile($requestData);

        if ($validator->fails()) {
            return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
        } else {
            $user = User::find(Auth::id());

            $user->email = $requestData['email'];
            $user->first_name = $requestData['first_name'];
            $user->patronymic = $requestData['patronymic'];
            $user->second_name = $requestData['second_name'];
            $user->phone = $requestData['phone'];

            $user->save();
        }

        return view('/home');
    }


    public function updatePassword(Request $request)
    {
        $requestData = $request->All();
        $validator = $this->validatePassword($requestData);

        if ($validator->fails()) {
            return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
        } else {
            $currentPassword = Auth::User()->password;
            if (\Hash::check($requestData['current_password'], $currentPassword)) {
                $userId = Auth::User()->id;
                $user = User::find($userId);
                $user->password = \Hash::make($requestData['password']);;
                $user->save();
                return view('/home');
            } else {
                $error = array('current_password' => 'Please enter correct current password');
                return response()->json(array('error' => $error), 400);
            }
        }
    }

}