<?php

use Faker\Generator as Faker;

$factory->define(App\Block::class, function (Faker $faker) {
  return [
    'latitude_1' => $faker->latitude($min = -44, $max = -43),
    'longitude_1' => $faker->longitude($min = -66, $max = -65),
    'latitude_2' => $faker->latitude($min = -44, $max = -43),
    'longitude_2' => $faker->longitude($min = -66, $max = -65),
    'street' => $faker->streetAddress,
    'numeration_max' =>rand(0,2000),
    'numeration_min' =>rand(0,2000),
  ];
});
