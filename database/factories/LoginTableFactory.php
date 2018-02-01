<?php

use Faker\Generator as Faker;

$factory->define(App\Login::class, function (Faker $faker) {
    return [
      'user_id'     => $faker->numberBetween(70,169),
      'ip'          => $faker->ipv4(),
      //'device_type' => $faker->,
      'platform'    => $faker->userAgent(),
      //'os'          => $faker->,
      //'latitude'    => $faker->,
      //'longitude'   => $faker->,
      'version'     => $faker->numberBetween(1,10),
    ];
});
