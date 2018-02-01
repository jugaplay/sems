<?php

use Faker\Generator as Faker;
use Carbon\Carbon; // Clase para manejar fechas de laravel

    $factory->define(App\SpaceReservatio::class, function (Faker $faker) {
    $identificador = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
    $inicio = Carbon::now();
    $fin = Carbon::now();
    $fin = $fin->addHour(48);
    $numero = $faker->unique->numberBetween(1,40);
    if(strlen($numero)<2){$numero = '0'.$numero;}
    $empresa = 'Empresa '.$numero;

    return [
      'identifier'   => $identificador,
      'company'      => $empresa,
      'start_time'   => $inicio,
      'end_time'     => $fin,
      'block_id'     => $faker->numberBetween(1,10),
      'latitude'     => $faker->latitude($min = -44, $max = -43),
      'longitude'    => $faker->longitude($min = -66, $max = -65),
      'operation_id' => $faker->numberBetween(1,10),
      'type'         => $faker->randomElement(['container','load unload']), // (container/load unload)
      'size'         => $faker->unique->numberBetween(1,10000),//(nro)
    ];
});
