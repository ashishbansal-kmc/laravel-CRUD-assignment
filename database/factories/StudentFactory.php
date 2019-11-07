<?php

use Faker\Generator as Faker;

$factory->define(App\Teacher::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'subject' => $faker->sentence(5),
        'address' => $faker->sentence(5),
        'teacher_id' => factory('App\Teacher')->create()->id,
    ];
});
