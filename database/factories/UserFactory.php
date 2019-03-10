<?php

use Faker\Generator as Faker;
use App\Http\Models\User\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'login' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('qwerty'), // secret
        'first_name' => $faker->name,
        'patronymic' => $faker->name,
        'second_name' => $faker->name,
        'invitation_key_id' => $faker->unique()->numberBetween(1),
        'phone' => $faker->phoneNumber,
    ];
});
