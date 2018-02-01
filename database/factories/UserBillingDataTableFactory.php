<?php

use Faker\Generator as Faker;

$factory->define(App\UserBillingData::class, function (Faker $faker) {

  $numeroUserBilling = $faker->unique->numberBetween(1,100);
  if(strlen($numeroUserBilling)<2){$numeroUserBilling = '0'.$numeroUserBilling;}
  $name = 'Empresa '.$numeroUserBilling.' S.A.';


    return [
      'user_id'         =>$faker->unique->numberBetween(1,29),
      'bussines_name'   =>$name,
      'tax_treatment'   =>$faker->numberBetween(1,5),
      'address'         =>$faker->streetAddress,
      'city'            =>$faker->city,
      'state'           =>$faker->state,
      'document_type'   => $faker->randomElement(['80','86','96']),
      'document_number' => $faker->numberBetween(13000000,30000000),
    ];
});
