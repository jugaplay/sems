<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
      'visible_type' => 'infringement',
      'visible_id'   => $faker->unique->numberBetween(1,5),
      'url'          => $faker->url(),
    ];
});
