<?php

use Faker\Generator as Faker;

$factory->define(App\Wallet::class, function (Faker $faker) {
    return [
      'user_id'  => $faker->unique->numberBetween(1,20),
      'balance'  => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000),
      'chips'    => $faker->numberBetween(1,20),
      'credit'   => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
    ];
});
