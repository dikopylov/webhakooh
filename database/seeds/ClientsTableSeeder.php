<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'id'   => 1,
            'name' => 'Анатолий',
            'phone' => '8989993',
            'chat_id' => 88889898,
        ]);
    }
}
