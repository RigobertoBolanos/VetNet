<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pet;
use Faker\Generator as Faker;

$factory->define(Pet::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'breed' => $faker->word,
        'age' => $faker->randomDigitNotNull,
        'owner' => $faker->randomDigitNotNull,
        'medicalhistory' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
