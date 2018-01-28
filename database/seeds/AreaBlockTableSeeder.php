<?php

use Illuminate\Database\Seeder;

class AreaBlockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\AreaBlock::class, 30)->create();
    }
}
