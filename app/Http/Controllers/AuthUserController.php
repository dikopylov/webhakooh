<?php


namespace App\Http\Controllers;

use App\Http\Models\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $requestData = $request->request->all();

        $validator = \Validator::make($requestData, [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($request->user()->id)
            ],
            'first_name' => 'required|string|max:255',
            'patronymic' => 'string|max:255',
            'second_name' => 'required|string|max:255',
            'phone' => [
                'required',
                'regex:/[0-9]{5,11}/',
                Rule::unique('users')->ignore($request->user()->id)
            ],
        ]);


        if ($validator->fails())
        {
            return redirect('edit/profile')->withErrors($validator);
        }

        $this->userRepository->updateProfile($request->user()->id, $requestData);

        return view('administration.home')->with('user', $this->userRepository->find($request->user()->id));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $requestData = $request->request->all();

        $validator = \Validator::make($requestData, [
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);

        $currentPassword = $request->user()->password;

        if ($validator->fails())
        {
            return redirect('edit/password')->withErrors($validator);
        }

        if (\Hash::check($requestData['current_password'], $currentPassword)) {
            $this->userRepository->updatePassword($request->user()->id, $requestData['password']);
            return view('administration.home')->with('user', $request->user());
        } else {
            $validator->errors()->add('current_password', 'Указан неверный пароль');
            return redirect('edit/password')->withErrors($validator);
        }
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