<?php

use Faker\Generator as Faker;
use Carbon\Carbon; // Clase para manejar fechas de laravel


$factory->define(App\Infringement::class, function (Faker $faker) {

  $letra = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
  $patente = $letra.' '.$faker->unique->numberBetween(100,999);

  $valor = $faker->numberBetween(1000,3000);
  $voluntario = $valor / 2;

  $inicio = Carbon::now();
  $fin = Carbon::now()->addHour(48);


    return [
      'plate'                 => $patente,
      'user_id'               => $faker->unique->numberBetween(1,29),
      'date'                  => $inicio,
      'situation'             => $faker->randomElement(['before','saved','voluntary','judge','close']),//(before/saved/voluntary/judge/close)
      'infringement_cause_id' => $faker->unique->numberBetween(1,20),
      'cost'                  => $valor,
      'voluntary_cost'        => $voluntario,
      'voluntary_end_date'    => $fin,
      //'close_date',
      //'close_cost',
      //'operation_id',
      'latitude'              => $faker->latitude($min = -44, $max = -43),
      'longitude'             => $faker->longitude($min = -66, $max = -65),
      'block_id'              => $faker->unique->numberBetween(1,10),
    ];
});
