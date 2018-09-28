<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'check.admin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereNull('is_delete')->get();
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('users.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        $this->validate($request, [
//            'login' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:6|confirmed',
//            'first_name' => 'required|string|max:255',
//            'patronymic' => 'string|max:255',
//            'second_name' => 'required|string|max:255',
//            'phone' => 'required|regex:/[0-9]{5,11}/|unique:users',
//        ]);
//
//        $user = User::create([
//            'login' => $request['login'],
//            'email' => $request['email'],
//            'password' => \Hash::make($request['password']),
//            'first_name' => $request['first_name'],
//            'patronymic' => $request['patronymic'],
//            'second_name' => $request['second_name'],
//            'phone' => $request['phone'],
//            'invitation_key' => 0,
//        ]);
//
//        $roles = $request['roles'];
//
//        if (isset($roles)) {
//
//            foreach ($roles as $role) {
//                $role_r = Role::findById($role);
//                $user->assignRole($role_r);
//            }
//        }
//
//        return redirect()->route('users.index');
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();

        return view('users.edit', compact('user', 'roles')); //pass user and roles data to view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'email' => 'required|string|email|max:255',
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'phone' => 'required|regex:/[0-9]{5,11}/',
        ]);

        $input = $request->only(['first_name','second_name', 'email', 'phone']);
        $roles = $request['roles'];
        $user->fill($input)->save();

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->is_delete = 1;
        $user->save();

        return redirect()->route('users.index');
    }
}
