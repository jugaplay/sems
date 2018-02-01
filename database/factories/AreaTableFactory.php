<?php
use Faker\Generator as Faker;

$factory->define(App\Area::class, function (Faker $faker) {
  $area_numero = $area_numero + 1;//$faker->unique->numberBetween(1,20);
  if(strlen($area_numero)<2){$area_numero = '0'.$area_numero;}
  $name = 'Area '.$area_numero;
  $details = $faker->sentence(4);

  return [
      'name' => $name,
      'details' => $details,
      //'active' => $faker->randomElement(['true','false']), //(true/false)
      'active' => rand(0,1), //(true/false)
  ];
});
