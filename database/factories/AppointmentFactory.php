<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Appointment;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {

    return [
        'pet' => $faker->randomDigitNotNull,
        'veterinary' => $faker->randomDigitNotNull,
        'services' => $faker->randomDigitNotNull,
        'date' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
