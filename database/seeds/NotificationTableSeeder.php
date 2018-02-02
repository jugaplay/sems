<?php

use Illuminate\Database\Seeder;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //factory(App\Notification::class, 10)->create();

      App\NotificationType::create([
        'name'        => 'Mail',
        'description' => 'Se envia un correo a la direccion del usuario',
        ]);

      App\NotificationType::create([
          'name'        => 'Mensaje de texto',
          'description' => 'Se envia un sms al telefono registrado por el usuario',
          ]);

      App\NotificationType::create([
            'name'        => 'WatsUp',
            'description' => 'Se envia un Mensaje al telefono registrado por el usuario',
            ]);
      $user =App\User::select('id', 'name','email')->where('type', 'conductor')->get();
      //echo('Usuario = '.$user. "\n");// --> Retorna un json
      //$usuarios = json_decode($user);
      //$contador = count($usuarios)-1; //Cantidad de registros encontrados

      foreach ($user as $usuario) {
        $estado = substr(str_shuffle("0123"), 0, 1);
        //$tipo_rnd = rand(0,3);
        //echo($usuario['name']. "\n");
        $destino = substr(str_shuffle("123"), 0, 1);
        App\Notification::create([
          'user_id'              =>$usuario['id'],
          'notification_type_id' =>$destino,
          'address'              => 'dirección de '.$usuario['name'],
        ]);
      }


    }
}
