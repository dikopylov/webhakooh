<?php

use App\Http\Models\ReservationStatus\ReservationStatus;
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
            ['title' => ReservationStatus::ALL],
            ['title' => ReservationStatus::NEW],
            ['title' => ReservationStatus::CONFIRMED],
            ['title' => ReservationStatus::REJECTED],
        ]);
    }
}
