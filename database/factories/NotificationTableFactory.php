<?php

use Faker\Generator as Faker;

$factory->define(App\Notification::class, function (Faker $faker) {
  $numero = $faker->unique->numberBetween(1,20);
  if(strlen($numero)<2){$numero = '0'.$numero;}
  $name = 'Dirección Mensaje '.$numero;

    return [
      'user_id'               =>$faker->unique->numberBetween(1,29),
      'notification_type_id'  =>$faker->numberBetween(1,10),
      'address'               => $name,

    ];
});
