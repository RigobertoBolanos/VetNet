<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MedicalRecord;
use Faker\Generator as Faker;

$factory->define(MedicalRecord::class, function (Faker $faker) {

    return [
        'diagnosis' => $faker->word,
        'treatments' => $faker->word,
        'consultationreason' => $faker->word,
        'date' => $faker->word,
        'veterinary' => $faker->randomDigitNotNull,
        'medicalhistory' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
