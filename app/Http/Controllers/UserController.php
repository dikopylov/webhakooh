<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

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
        $users = User::whereNull('is_delete')->where('id', '<>', \Auth::id())->get();
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();

        if ($user->hasRole('Администратор'))
        { //Сделать норм обработчик.
            abort('401', 'THERE ISN\'T ACCESS TO ADMIN EDIT');
        }
        else
        {
            return view('users.edit', compact('user', 'roles'));
        }

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
