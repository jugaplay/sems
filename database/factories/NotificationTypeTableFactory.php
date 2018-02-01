<?php

use Faker\Generator as Faker;

$factory->define(App\NotificationType::class, function (Faker $faker) {
  $numero = $faker->unique->numberBetween(1,100);
  if(strlen($numero)<2){$numero = '0'.$numero;}
  $name = 'Notificación '.$numero;

    return [
      'name' => $name,
      'description' => $faker->sentence(4),
      ];
});
