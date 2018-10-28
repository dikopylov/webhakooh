<?php

use Faker\Generator as Faker;
use App\Http\Models\Platen\Platen;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Platen::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'capacity' => $faker->numberBetween(1, 50)
    ];
});
