<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Администратор',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'Менеджер',
            'guard_name' => 'web',
        ]);



    }
}
