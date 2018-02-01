<?php

use Faker\Generator as Faker;

$factory->define(App\Local::class, function (Faker $faker) {
    return [
      'user_id'     => $faker->unique->numberBetween(1,29),
      'latitude'    => $faker->latitude($min = -44, $max = -43),
      'longitude'   => $faker->longitude($min = -66, $max = -65),
      'fee'         => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 20), // 48.8932
      'verified'    => $faker->randomElement(['S','N']),
      'address'     => $faker->streetAddress,
    ];
});
