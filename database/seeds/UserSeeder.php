<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
//use App\Users;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('users')->insert([
          'name' 				=>	'Administrador General',
          'email'				=>	'administradorgeneral@gmail.com',
          'phone'			  =>	'1544008341',
          'type'        =>  'admsuper',
          'account_status' => 'A',
          'password' => bcrypt('123456'),
          ]);

        //factory(App\User::class, 100)->create();
    }
}
