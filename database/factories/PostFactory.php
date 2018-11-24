<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->country, 
        'body' => $faker->sentence,
        'user_id' => User::inRandomOrder()->first()['id'],
    ];
});
