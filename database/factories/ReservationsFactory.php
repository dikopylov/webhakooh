<?php

use App\Http\Models\Reservation\Reservation;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    return [
        'platen_id'     => $faker->numberBetween(0, 5),
        'date'          => $faker->dateTime(),
        'status_id'     => $faker->numberBetween(0, 3),
        'count_persons' => $faker->numberBetween(1, 11),
        'comment'       => $faker->text(10),
    ];
});