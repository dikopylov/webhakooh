<?php


namespace App\Http\Models\Role;

use App\Http\Models\User\User;
use Spatie\Permission\Models\Role;

class RoleRepository
{
    /**
     * @return mixed
     */
    public function get()
    {
        return Role::get();
    }

    public function hasRole(User $user, string $role)
    {
        return $user->hasRole($role);
    }

    public function getAll()
    {
        return Role::all();
    }

    public function findOrFail(int $id)
    {
        return Role::findOrFail($id);
    }

    public function assignRole(User $user, string $role)
    {
        return $user->assignRole($role);
    }
}