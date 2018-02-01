<?php

use Faker\Generator as Faker;

$factory->define(App\OperationBetweenWallet::class, function (Faker $faker) {

    return [
      'operation_id_1' => $faker->numberBetween(1,10),
      'operation_id_2' => $faker->numberBetween(1,10),
    ];
});
