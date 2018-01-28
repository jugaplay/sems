<?php

use Illuminate\Database\Seeder;

class BlockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Block::class, 10)->create();
    }
}
