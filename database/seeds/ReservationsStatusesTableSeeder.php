<?php

use Illuminate\Database\Seeder;

class ReservationsStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservation_statuses')->insert([
            ['title' => 'Новый'],
            ['title' => 'Подтвержден'],
            ['title' => 'Отклонен'],
        ]);
    }
}
