<?php

use Faker\Generator as Faker;

$factory->define(App\Operation::class, function (Faker $faker) {

      return [
      'type'    => $faker->randomElement(['wallet','ticket','infringement']), //(wallet/ticket/infringement)
      'type_id' => $faker->numberBetween(1,10),
      'amount'  => $faker->numberBetween(12,3000),
    ];
});
