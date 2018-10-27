<?php

use Illuminate\Database\Seeder;

class InvitationKeysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invitation_keys')->insert([
            'key' => 'admin',
            'author_id' => 0,
            'is_used' => true,
        ]);
    }
}
