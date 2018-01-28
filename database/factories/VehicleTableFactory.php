<?php

use Faker\Generator as Faker;

$factory->define(App\Vehicle::class, function (Faker $faker) {
    $patente = $faker->unique->word(7);
    return [
        'plate' => $patente,
    ];
});
