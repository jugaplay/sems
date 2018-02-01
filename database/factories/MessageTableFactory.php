<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {

  $numero = $faker->unique->numberBetween(1,20);
  if(strlen($numero)<2){$numero = '0'.$numero;}
  $name = 'Mensaje '.$numero;

    return [
      'name'    => $name,
      'mail'    => $faker->safeEmail,
      'date'    => $faker->date($format = 'Y-m-d', $max = 'now'),
      'state'   => $faker->randomElement(['0','1','2','3']),
      'user_id' => $faker->unique->numberBetween(1,29),
      'type'    => $faker->randomElement(['claim','consult','message']), // (claim/consult/message)
    ];
});
