<?php

use Faker\Generator as Faker;

$factory->define(App\AreaBlock::class, function (Faker $faker) {
    return [
      'block_id' => $faker->numberBetween(1,10),
      'area_id'  => $faker->numberBetween(1,10),
        //
    ];
});
