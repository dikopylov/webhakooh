<?php

namespace App\Http\Controllers;

use App\Http\Models\Role\RoleRepository;
use App\Http\Models\Role\RoleType;
use App\Http\Models\User\UserRepository;
use Illuminate\Http\Request;

class UsersManagementSystemController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->middleware(['auth', 'check.delete', 'check.admin' ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAll(\Auth::id());

        return view('users.index')->with('users', $users);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('users');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @TODO Сделать норм обработчик.
     */
    public function edit($id)
    {

        $user  = $this->userRepository->find($id);
        $roles = $this->roleRepository->get();

        if ($this->roleRepository->hasRole($user,RoleType::ADMINISTRATOR)) {
            abort('401', 'THERE ISN\'T ACCESS TO ADMIN EDIT');
        }
        else {
            return view('users.edit', compact('user', 'roles'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->userRepository->find($id);

        $roles = $request['roles'];

        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        }
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);
    }
}
