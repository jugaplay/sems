<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables(['areas','areas_blocks','blocks','users','vehicles']);


        $this->call(UserSeeder::class);
        $this->call( AreaTableSeeder::class);
        $this->call( BlockTableSeeder::class);
        $this->call( AreaBlockTableSeeder::class);
        $this->call( VehiclesTableSeeder::class);
    }


    // Funcion para el borrado de tablas en forma dinamica
    protected function truncateTables(array $tables)
    {
      db::statement('SET FOREIGN_KEY_CHECKS = 0;');

      foreach($tables as $table){
        db::table($table)->truncate();
      }

      db::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }

}
