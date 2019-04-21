<?php

use Faker\Generator as Faker;
use App\Profile;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'link' => $faker->randomLetter,
    ];
});
