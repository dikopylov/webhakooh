<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'login' => 'admin',
            'email' => 'fakeblin@gmail.com',
            'password' => Hash::make('admin1'),
            'first_name' => 'Ivan',
            'patronymic' => 'Ivanovich',
            'second_name' => 'Ivanov',
            'phone' => '8982211',
            'is_admin' => 1,
            'invitation_key' => '0',
        ]);
    }
}
