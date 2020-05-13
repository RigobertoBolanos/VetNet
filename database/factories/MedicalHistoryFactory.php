<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MedicalHistory;
use Faker\Generator as Faker;

$factory->define(MedicalHistory::class, function (Faker $faker) {

    return [
        'pet' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
