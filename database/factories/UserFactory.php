<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'api_token' => str_random(10),
        'social_network_token' => str_random(10),
        'social_network' => $faker->randomElement(['facebook', 'twitter', 'github']),
        'avatar' => $faker->imageUrl()
    ];
});
