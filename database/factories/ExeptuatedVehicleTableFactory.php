<?php

use Faker\Generator as Faker;

$factory->define(App\ExeptuatedVehicle::class, function (Faker $faker) {
    return [
      'vehicle_id'    => $faker->unique->numberBetween(1,20),
      'detail'        => $faker->sentence(4),
      'start_time'    => $faker->dateTime($max = 'now', $timezone = null),
      'end_time'      => '1999-12-31',
      'operation_id'  => $faker->numberBetween(1,10),
      'type'          => $faker->randomElement(['neighbors','journalist','others']), //(neighbors/journalist/others)
    ];
});
