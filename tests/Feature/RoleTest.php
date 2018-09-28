<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;



class RoleTest extends TestCase
{
    /**
     * @test
     */
    public function RoleTest()
    {
        $user = User::find(1);
        $user->assignRole('manager');
        $roles = $user->getRoleNames();
        var_dump($roles);
        $this->assertEquals('manager', $roles[1]);

    }
}
