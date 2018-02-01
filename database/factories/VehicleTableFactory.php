<?php

use Faker\Generator as Faker;

$factory->define(App\Vehicle::class, function (Faker $faker) {
    $letra = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
    $patente = $letra.$faker->unique->numberBetween(100,999);
    return [
        'plate' => $patente,
    ];
});
