<?php

use Faker\Generator as Faker;

$factory->define(App\MessageDetail::class, function (Faker $faker) {
    return [
      'message_id' => $faker->unique->numberBetween(1,10),
      'detail'     => $faker->sentence(4),
      'date'       => $faker->date($format = 'Y-m-d', $max = 'now'),
      'state'      => $faker->randomElement(['0','1','2','3']), // (0-not open/1-open/2-end/3-suspended), default es 0,
    ];
});
