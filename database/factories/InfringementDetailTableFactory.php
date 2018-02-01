<?php

use Faker\Generator as Faker;

$factory->define(App\InfringementDetail::class, function (Faker $faker) {
    return [
      'user_id'         => $faker->unique->numberBetween(1,29),
      'infringement_id' => $faker->unique->numberBetween(1,5),
      'detail'          => $faker->sentence(4),

    ];
});
