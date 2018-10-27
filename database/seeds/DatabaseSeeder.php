<?php

use Illuminate\Database\Seeder;
use \App\Http\Models\InvitationKey\InvitationKey;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);

    }
}
