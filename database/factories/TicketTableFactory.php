<?php

use Faker\Generator as Faker;
use Carbon\Carbon; // Clase para manejar fechas de laravel

$factory->define(App\Ticket::class, function (Faker $faker) {

  $letra = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
  $patente = $letra.' '.$faker->unique->numberBetween(100,999);
  //$inicio = $faker->dateTime($max = 'now', $timezone = null);
  $inicio = Carbon::now();
  $fin = Carbon::now();
  //$inicio = $date;
  $tipo = $faker->randomElement(['time','day']); //(time/day)
  $horas  = $faker->numberBetween(1,8);
  if($tipo == 'time'){
    $fin = $fin->addHour($horas);}
    else {
      $horas = 0;
      $fin = substr($inicio,0,10).' 23:59:59';
    }

    return [
      'user_id'      => $faker->numberBetween(1,29),
      'plate'        => $patente,
      'time'         => $horas,
      'start_time'   => $inicio,
      'end_time'     => $fin,
      'block_id'     => $faker->numberBetween(1,10),
      'latitude'     => $faker->latitude($min = -44, $max = -43),
      'longitude'    => $faker->longitude($min = -66, $max = -65),
      'check'        => $faker->numberBetween(1,29),//(null/user_id que lo chequeo)
      'operation_id' => $faker->numberBetween(1,10),
      'token'        => $faker->swiftBicNumber(),
      'type'         => $tipo, //(time/day)

    ];
});
