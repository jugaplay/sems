<?php

use Faker\Generator as Faker;

$factory->define(App\Bill::class, function (Faker $faker) {

    $neto = $faker->randomFloat($nbMaxDecimals = 2, $min = 9.92, $max = 2000);
    $iva  = $neto * 1.21;
    $total = $neto + $iva;

    return [
      'type'              => $faker->randomElement(['F','C','D']),
      'letter'            => $faker->randomElement(['A','B']),
      'branch_office'     => '0001',
      'number'            => $faker->unique->numberBetween(1,20),
      'document_type'     => $faker->randomElement(['80','86','96']),
      'document_number'   => $faker->numberBetween(13000000,30000000),
      'net'               => $neto,
      'iva'               => $iva,
      'total'             => $total,
      'date'              => date('Y-m-d'),
      'detail'            => $faker->randomElement(['Ticket','Recarga','Multa']),
    ];
});
