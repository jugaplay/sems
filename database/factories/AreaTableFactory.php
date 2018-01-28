<?php
use Faker\Generator as Faker;

$factory->define(App\Area::class, function (Faker $faker) {
  $numero = $faker->unique->numberBetween(1,20);
  if(strlen($numero)<2){$numero = '0'.$numero;}
  $name = 'Area '.$numero;
  $details = $faker->sentence(4);

  return [
      'name' => $name,
      'details' => $details,
      //'active' => $faker->randomElement(['true','false']), //(true/false)
      'active' => rand(0,1), //(true/false)
  ];
});
