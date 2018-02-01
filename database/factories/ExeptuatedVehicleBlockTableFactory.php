<?php

use Faker\Generator as Faker;

$factory->define(App\ExeptuatedVehicleBlock::class, function (Faker $faker) {
    return [
      'exeptuated_vehicle_id' =>$faker->unique->numberBetween(1,10),
      'block_id'              =>$faker->numberBetween(1,10),
    ];
});
