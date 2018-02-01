<?php

use Faker\Generator as Faker;

$factory->define(App\OperationsBill::class, function (Faker $faker) {
    return [
      'operation_id' => $faker->unique->numberBetween(1,10),
      'bill_id'      => $faker->unique->numberBetween(1,10),
    ];
});
