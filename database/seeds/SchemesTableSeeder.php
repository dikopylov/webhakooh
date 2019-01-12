<?php

use Illuminate\Database\Seeder;

class SchemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = pathinfo(__DIR__ . '/../../public/img/scheme.jpg' , PATHINFO_EXTENSION);
        $data = file_get_contents(__DIR__ . '/../../public/img/scheme.jpg');

        DB::table('schemes')->insert([
            'name' => 'scheme-file',
            'base64' => 'data:image/' . $type . ';base64,' . base64_encode($data),
        ]);
    }
}
