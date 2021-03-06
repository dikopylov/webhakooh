<?php

use Illuminate\Database\Seeder;
use \App\Http\Models\Role\RoleType;
use App\Http\Models\User\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create();

        DB::table('users')->insert([
            'login' => 'admin',
            'email' => 'fakeblin@gmail.com',
            'password' => Hash::make('admin1'),
            'first_name' => 'Ivan',
            'patronymic' => 'Ivanovich',
            'second_name' => 'Ivanov',
            'phone' => '8982211',
            'invitation_key_id' => 0,
        ]);

        User::find(DB::getPdo()->lastInsertId())->assignRole(RoleType::ADMINISTRATOR);
    }
}
