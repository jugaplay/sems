<?php

use Faker\Generator as Faker;

$factory->define(App\VehicleUser::class, function (Faker $faker) {
    return [
      'vehicle_id' => $faker->unique->numberBetween(1,100),
      'user_id'    => $faker->numberBetween(70,169),
    ];
});
