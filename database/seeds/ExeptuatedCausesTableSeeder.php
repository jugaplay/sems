<?php

use Illuminate\Database\Seeder;

class ExeptuatedCausesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\ExeptuatedCauses::create([
          'name' 				=>	'Lisiado',
          'detail'				=>	'Con certificad del ......',
          ]);

    App\ExeptuatedCauses::create([
      'name' 				=>	'frentistas',
      'detail'				=>	'Vive en la zona',
      ]);

      App\ExeptuatedCauses::create([
        'name' 				=>	'periodistas',
        'detail'				=>	'Por la profecion en que trabaja',
      ]);

      App\ExeptuatedCauses::create([
        'name' 				=>	'otros',
        'detail'				=>	'Causas no contempladas',
      ]);
  }
}
