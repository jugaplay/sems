<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
'name' 				=>	'Wernicke Matias',
'email'				=>	'matiaswernickec@gmail.com',
'phone'			  =>	'1544008341',
'type'        =>  'X',
'account_status' => 'A',
'password' => bcrypt('123456'),

*/

$factory->define(App\User::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' =>	$faker->phoneNumber,
        'type' =>  $faker->randomElement(['local','conductor','inspector','asistente','juez','adm','admsuper','municipal']),
        'account_status' => 'A',
        'password' => $faker->password,
        'remember_token' => str_random(10),
    ];
});
