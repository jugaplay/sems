<?php

use Faker\Generator as Faker;

$factory->define(App\InfringementCause::class, function (Faker $faker) {
  $numero_inf = $faker->unique->numberBetween(1,40);
  if(strlen($numero_inf)<2){$numero_inf = '0'.$numero_inf;}
  $name = 'Causa Infraccion '.$numero_inf;
  $details = $faker->sentence(4);

  $valor = $faker->numberBetween(1000,3000);
  $voluntario = $valor / 2;

    return [
      'name'           => $name,
    	'detail'         =>$faker->sentence(4),
    	'cost'           => $valor,
      'voluntary_cost' => $voluntario,
      //
    ];
});
