<?php

use Illuminate\Database\Seeder;
use \App\Http\Models\Platen\Platen;

class PlatensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Platen::class, 5)->create();
    }
}
