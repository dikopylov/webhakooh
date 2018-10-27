<?php


namespace App\Http\Controllers;

use App\Http\Models\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AuthUserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
     * @TODO исправить баг, что пользователь может вводит УЖЕ имеющие в базе телефон и имеил
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    protected function validateProfile(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'first_name' => 'required|string|max:255',
            'patronymic' => 'string|max:255',
            'second_name' => 'required|string|max:255',
            'phone' => 'required|regex:/[0-9]{5,11}/',
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
            $user = $this->userRepository->find(Auth::id());

            $user->email = $requestData['email'];
            $user->first_name = $requestData['first_name'];
            $user->patronymic = $requestData['patronymic'];
            $user->second_name = $requestData['second_name'];
            $user->phone = $requestData['phone'];

            $user->save();
        }

        return view('administration.home')->with('user', $user);
    }


    public function updatePassword(Request $request)
    {
        $validator = $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);

//        if ($validator->fails()) {
////            return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
//        } else {
//            $currentPassword = Auth::User()->password;
//            if (\Hash::check($requestData['current_password'], $currentPassword)) {
//                $user = $this->userRepository->find(Auth::User()->id);
//                $user->password = \Hash::make($requestData['password']);;
//                $user->save();
//                return view('administration.home')->with('user', $user);
//            } else {
//                $error = array('current_password' => 'Please enter correct current password');
//                return response()->json(array('error' => $error), 400);
//            }
//        }

//        dd($validator);
        return redirect()->route('edit/password')->withErrors(['error' => 'current_password']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return redirect()->route('users.index');
    }
}