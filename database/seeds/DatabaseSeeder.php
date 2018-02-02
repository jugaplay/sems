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
        $this->truncateTables(['areas',
                               'areas_blocks',
                               'bills',
                               'blocks',
                               'company_sales',
                               'exeptuated_vehicles',
                               'infringements',
                               'infringement_causes',
                               'infringement_details',
                               'images',
                               'locals',
                               'Notification_types',
                               'messages',
                               'message_details',
                               'operations',
                               'operation_between_wallets',
                               'operation_bills',
                               'space_reservatios',
                               'tickets',
                               'users',
                               'users_billing_datas',
                               'vehicles',
                               'exeptuated_causes',
                             ]);


        $this->call(UserSeeder::class);
        $this->call(ExeptuatedCausesTableSeeder::class);
        $this->call(NotificationTableSeeder::class);
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
