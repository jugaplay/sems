<?php

namespace App\Http\Controllers;

use App\User;
use App\Wallet;
use App\Vehicle;
use App\VehicleUser;
use App\Notification;
use App\NotificationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
      //$companies = Company::all();
      if(Auth::check()){
        if(Auth::user()->type=="driver" && Auth::user()->account_status!="B" ){
          $notifications = NotificationType::all();
          $notificationChannelsIds = Auth::user()->notificationChannels()->get()->transform(function($objet,$key){
            return $objet->notification_type_id;
          })->toArray();
          foreach ($notifications as $notification) {
            $notification->active=in_array($notification->id, $notificationChannelsIds);
          }
          return view('users.index',['notifications'=>$notifications]);
        }
      }
      return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(Auth::check()){
        if(Auth::user()->type=="admsuper" && Auth::user()->account_status!="B" ){
          // Verificaciones
          if (empty($request->input('createPassword'))) {
              return response()->json(["error"=>"La clave no puede estar vacia"],400);
          }
          if (empty($request->input('createMail'))) {
              return response()->json(["error"=>"El mail es obligatorio"],400);
          }
          $userExist = User::where('email', $request->input('createMail'))->get();
          if (count($userExist) > 0) {
              return response()->json(["error"=>"El mail ya se encuentra en uso"],400);
          }
          // Grabo Usuario
          $user=User::create([
          'name' => $request->input('createName'),
          'email' => $request->input('createMail'),
          'phone' => $request->input('createPhone'),
          'type' => parseAccountType($request->input('createAccountType')),
          'account_status' => parseAccountStatus($request->input('createAccountStatus')),
          'password' => bcrypt($request->input('createPassword')),
            ]);
            if(!$user->save()){
              return response()->json(["error"=>"Error creando el usuario en la base de datos"],422);
            }
            $id_user = $user->id; // Retorna el id del insert ejecutado
            // Generar una billetera
            $userWallet=Wallet::create([
                'user_id' => $id_user,
                'balance' => 0,
                'chips'   => 0,
                'credit'  => 0,
                ]);
           // Genra datos empresa
           if(!$userWallet->save()){
             return response()->json(["error"=>"Error creando la billetera en la base de datos"],422);
           }
          // Fin grabo y devulvo algunos datos del usuario
          return response()->json($user);
        }else{
          // No tiene permiso para esta accion
          return response()->json(["error"=>"Sin permiso para crear un usuario"],403);
        }
      }else{// Tiene que hacer el login primero
        return response()->json(["error"=>"Tiene que estar logueado"],401);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }
    public function showAll(){
      $users = User::where('type','!=','local')->get();
      $arrOfUsers=array();
      foreach ($users as $user) {
        array_push($arrOfUsers,[
          $user->name,
          $user->email,
          $user->phone,
          parseAccountType($user->type),
          parseAccountStatus($user->account_status),
          $user->id
          ]);
      }
      return response()->json([
          'aaData' => $arrOfUsers
      ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
          return view('users.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
      if(Auth::check()){
        if(Auth::user()->type=="admsuper" && Auth::user()->account_status!="B" ){
          // Por alguna razon no me trae el usuario
          //$user= User::where('id',$request->input('userId'))->first();
          // Verificaciones
          $changePassword = (empty($request->input('editPassword'))) ? false : true;
          if (empty($request->input('editMail'))) {
              return response()->json(["error"=>"El mail es obligatorio"],400);
          }
          if($user->email!=$request->input('editMail')){
            $userExist = User::where('email', $request->input('editMail'))->get();
            if (count($userExist) > 0) {
                return response()->json(["error"=>"El mail ya se encuentra en uso"],400);
            }
          }
          $userUpdate = User::where('id', $user->id)
                      ->update([
                        'name' => $request->input('editName'),
                        'email' => $request->input('editMail'),
                        'phone' => $request->input('editPhone'),
                        'type' => parseInverseAccountType($request->input('editAccountType')),
                        'account_status' => parseInverseAccountStatus($request->input('editAccountStatus')),
                      ]);
          if(!$userUpdate){
            return response()->json(["error"=>"Error actualizando los datos del usuario en la base de datos"],422);
          }
          if($changePassword){ // Si cambio la contraseña
            $userUpdate = User::where('id', $user->id)->first();
            $userUpdate->password=bcrypt($request->input('password'));
            $userUpdate->save();
            if(!$userUpdate){
              return response()->json(["error"=>"Error actualizando la contraseña del local en la base de datos"],422);
            }
          }

          // Fin grabo y devulvo algunos datos del usuario
          return response()->json($user);
        }else{
          // No tiene permiso para esta accion
          return response()->json(["error"=>"Sin permiso para editar un local"],403);
        }
      }else{// Tiene que hacer el login primero
        return response()->json(["error"=>"Tiene que estar logueado"],401);
      }
    }
    public function profileConfiguration(Request $request){
      if(Auth::check()){
        if(Auth::user()->type=="driver" && Auth::user()->account_status!="B" ){
          // Primero es a validar si tiene la password lo que necesita password
          // Si actualiza el celular, o el mail deberia actualizar los campos de los mensajes
          $configurationName=$request->input('configurationName');
          $configurationMail=$request->input('configurationMail');
          $configurationPhone=$request->input('configurationPhone');
          $configurationPassword=$request->input('configurationPassword');
          if($configurationMail!=Auth::user()->email || $configurationPhone!=Auth::user()->phone || $configurationPassword!="" && $request->has('configurationActualPassword')){
            // Si cambia algo sensible tiene que pedir la contraseña viejs
            if (!(Hash::check($request->input('configurationActualPassword'), Auth::user()->password))) { // valida contra la contraseña con hash
                // Not valid
                return response()->json(["error"=>"La contraseña ingresada es incorrecta"],400);
            }
          }
          if($configurationMail!=Auth::user()->email){
            if (count(User::where('email', $configurationMail)->get()) > 0) {
                return response()->json(["error"=>"El mail ingresado ya se encuentra en uso"],400);
            }else{
              $userUpdate = Auth::user()->update([
                            'email' => $configurationMail,
                            'account_status' => 'N'
                          ]);
              if(!$userUpdate){
                return response()->json(["error"=>"Error actualizando el mail del usuario en la base de datos"],422);
              }
                // Pendiente enviar mail para confirmar la cuenta
              // Actualizo las notificaciones que tengan mails Mail
              $notification_types=NotificationType::where('name','Mail')->first();
              $channel=Auth::user()->notificationChannels()->where('notification_type_id',$notification_types->id)->first();
              if($channel){// Si existe un canal
                $userUpdate = $channel->update(['address' => $configurationMail]);
                if(!$userUpdate){
                  return response()->json(["error"=>"Error actualizando el mail de los mensajes en la base de datos"],422);
                }
              }
            }
          }
          if($configurationPhone!=Auth::user()->phone){
            $phoneVariables=["Whatsapp","SMS"];
            foreach ($phoneVariables as $value) {
              $notification_types=NotificationType::where('name',$value)->first();
              $channel=Auth::user()->notificationChannels()->where('notification_type_id',$notification_types->id)->first();
              if($channel){// Si existe un canal
                $userUpdate = $channel->update(['address' => $configurationPhone]);
                if(!$userUpdate){
                  return response()->json(["error"=>"Error actualizando el ".$value." de los mensajes en la base de datos"],422);
                }
              }
            }
          }
          // $request->has('configurationActualPassword') Whatsapp
          if($configurationPassword!=""){ // Si cambio la contraseña, ya cheque arriba que haya ingresado la vieja
            if(strlen ($configurationPassword)<6){
              return response()->json(["error"=>"La contraseña debe tener al menos 6 caracteres "],400);
            }
            Auth::user()->password=bcrypt($configurationPassword);
            if(!Auth::user()->save()){// Lo guarda y lo revisa
              return response()->json(["error"=>"Error actualizando la contraseña del usuario en la base de datos"],422);
            }
          }
          $notification_types=NotificationType::all();
          foreach ($notification_types as $notification_type) {
            if($request->has('notification'.$notification_type->id)){// tendria que trader_cdleveningstar
              if(!Auth::user()->notificationChannels()->where('notification_type_id',$notification_type->id)->first()){// Si no tiene
                $notification=new Notification;
                $notification->notification_type_id=$notification_type->id;
                switch ($notification_type->name) {
                  case 'SMS':
                      $notification->address=$configurationPhone;
                    break;
                  case 'Whatsapp':
                      $notification->address=$configurationPhone;
                    break;
                  case 'Mail':
                      $notification->address=$configurationMail;
                    break;
                  case 'App / Notificación interna':
                      $notification->address="Pendiente";
                    break;
                  default:
                    $notification->address="Error";
                    break;
                }
                Auth::user()->notificationChannels()->save($notification);
              }
            }else{
              $notification=Auth::user()->notificationChannels()->where('notification_type_id',$notification_type->id)->first();
              if($notification){// Si tiene
                $notification->delete();
              }
            }
          }
          // Si cambio el mail, verificar que el mail no exista
          $userUpdate = Auth::user()->update([
                        'name' => $configurationName,
                        'email' => $configurationMail,
                        'phone' => $configurationPhone
                      ]);
          if(!$userUpdate){
            return response()->json(["error"=>"Error actualizando los datos del usuario en la base de datos"],422);
          }
          // Me falta lo de los autos
          $submitedVehicles = explode(",", $request->input('domain-input'));
          $actualVehicles=Auth::user()->vehicles()->get()->transform(function($objet,$key){
            return $objet->plate;
          })->toArray();
          $addVehicles=array_diff($submitedVehicles,$actualVehicles);
          $removeVehicles=array_diff($actualVehicles,$submitedVehicles);
          $generalFunctions = new generalFunctions();
          foreach ($addVehicles as $plate) {
              $vehicle_id = $generalFunctions->registerVehicle($plate);
              Auth::user()->vehicles()->attach($vehicle_id); // El contrario es $user->roles()->detach(1);
            }
          foreach ($removeVehicles as $plate) {
              $vehicle_id = $generalFunctions->registerVehicle($plate);
              Auth::user()->vehicles()->detach($vehicle_id);
            }
          // Si cambia el mail, poner la cuenta en que no valido el nuevo mail y enviar un mail, ademas cambiar todos los inputs de mails
          return response()->json(['user'=>Auth::user(),'vehicles'=>Auth::user()->vehicles()->get(),'notifications'=>Auth::user()->notificationChannels()->get()]);
        }else{
          // No tiene permiso para esta accion
          return response()->json(["error"=>"Sin permiso para editar el perfil"],403);
        }
      }else{// Tiene que hacer el login primero
        return response()->json(["error"=>"Tiene que estar logueado"],401);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function userVehicles()
    {
        //
        return view('users.vehicles');
    }

    public function associateVehicle(Request $request){
      //echo "Patente = ".$request->input('plate'). "<br>" ;
      $user_id = Auth::user()->id;
      //echo "Usuario = ".$user_id. "<br>" ;

      // Busca si existe
        $VehicleExist = Vehicle::where('plate', $request->input('plate'))->first();
        echo 'Vehiculos => '.$VehicleExist."<br>";
        echo "Cantidad encontrada = ".count($VehicleExist)."<br>";

        if (!$VehicleExist) {
          echo "Vehiculo no existe. Grabarlo y asociarlo "."<br>";
          // Crea el vehiculo
          $vehicle=Vehicle::create([
            'plate' => $request->input('plate'),
          ]);
          if($vehicle){
            // Asocia el vehiculo creado al usuario
            $vehicle->users()->attach(Auth::user()->id);
          }else{
            echo("Error en crear vehiculo");
          }

        }else{
          echo "Vehiculo YA existe verificar que este asociado=> ".$VehicleExist."<br>";
          $assosiated=$VehicleExist->users()->where('user_id', $user_id)->first();
          if (!$assosiated) {
            Auth::user()->vehicles()->attach($VehicleExist->id);
          }
        }
        //

          }

          public function userVehiclesOff()
          {
              //
              //$user_id = Auth::user()->id;
              //$user = User::where('id', $user_id)->first();
              //dump($user);
              // $findVehicles = $user->vehicles()->get();
              // es lo mismo que wscribir
              $findVehicles = Auth::user()->vehicles()->get();
              return view('users.vehiclesOff',['findVehicles'=>$findVehicles]);
          }

          public function disassociateVehicle(Request $request){
            echo "Patente = ".$request->input('plate_id'). "<br>" ;
            Auth::user()->vehicles()->detach($request->input('plate_id'));

          }
          public function register(Request $request){
            // Creo el registro aca!
            //return response()->json($request);
            if (count(User::where('email', $request->input('registerEmail'))->get()) > 0) {
                return response()->json(["error"=>"El mail ingresado ya se encuentra en uso"],400);
            }
            if(strlen ( $request->input('registerPassword'))<6){
              return response()->json(["error"=>"La contraseña debe tener al menos 6 caracteres "],400);
            }
            $user=User::create([
                'name' => $request->input('registerName'),
                'email' => $request->input('registerEmail'),
                'password' => bcrypt($request->input('registerPassword')),
                'type'=>"driver",
                'account_status'=>"N",
            ]);
            if(strlen($request->input('registerPhone'))>6){
              $user->phone=$request->input('registerPhone');
              $user->save();
            }
            $userWallet=Wallet::create([
                'user_id' => $user->id,
                'balance' => 0,
                'chips'   => 0,
                'credit'  => 0,
                ]);
           // Genra datos empresa
           if(!$userWallet->save()){
             return response()->json(["error"=>"Error creando la billetera"],422);
           }
            // tengo que crear la billetera
            $remember=($request->input('registerRemember')=="on")?true:false;
            Auth::login($user, $remember);// Remember true/false
            // Deberia mandar el mail para confirmar el mail
            return response()->json($user);
          }
          public function login(Request $request){
            // Verifico que la cuenta no este cancelada?
            $remember=($request->input('loginRemember')=="on")?true:false;
            if (Auth::attempt(['email' => $request->input('loginEmail'), 'password' => $request->input('loginPassword')], $remember)) {
                return response()->json(Auth::user());
            }else{
              return response()->json(["error"=>"Los datos no corresponden a un usuario registrado"],400);
            }
          }
          public function recover(Request $request){
            // Creo el registro aca!
            if (count(User::where('email', $request->input('recoverEmail'))->get()) > 0) {
              return response()->json(["mail"=>"enviado"]);
            }else{
              return response()->json(["error"=>"El mail ingresado no corresponden a un usuario registrado"],400);
            }
          }

} // function associateVehicle
