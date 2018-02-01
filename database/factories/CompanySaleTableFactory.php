<?php

use Faker\Generator as Faker;

$factory->define(App\CompanySale::class, function (Faker $faker) {
    return [
      'user_id'       =>$faker->unique->numberBetween(1,29),
      'operation_id'  =>$faker->numberBetween(1,10),
      'detail'        =>$faker->sentence(4),
    ];
});
