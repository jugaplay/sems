<?php

use Illuminate\Database\Seeder;
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
        factory(App\User::class, 29)->create();

        DB::table('users')->insert([
          'name' 				=>	'Wernicke Matias',
          'email'				=>	'matiaswernickec@gmail.com',
          'phone'			  =>	'1544008341',
          'type'        =>  'admsuper',
          'account_status' => 'A',
          'password' => bcrypt('123456'),
          ]);
    }
}
