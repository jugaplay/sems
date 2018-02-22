<?php

namespace App\Http\Controllers;

use App\User;
use App\Wallet;
use App\Vehicle;
use App\VehicleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

function parseAccountStatus($status){
  switch ($status) {
    case "C":
      return "Confirmada";
      break;
    case "N":
      return "No confirmada";
      break;
    case "B":
      return "Baja";
      break;
    default:
      return "Otro";
      break;
  }
}
function parseInverseAccountStatus($status){
  switch ($status) {
    case "Confirmada":
      return "C";
      break;
    case 'No confirmada':
      return "N";
      break;
    case 'Baja':
      return "B";
      break;
    default:
      return "O";
      break;
  }
}
function parseAccountType($type){
  switch ($type) {
    case "inspector":
      return "Inspector";
      break;
    case "judge":
      return "Juez";
      break;
    case "admin":
      return "Administrador";
      break;
    case "admsuper":
      return "Super admin";
      break;
    case "city":
      return "Municipalidad";
      break;
    case "driver":
      return "Conductor";
      break;
    default:
      return "Otro";
      break;
  }
}
function parseInverseAccountType($type){
  switch ($type) {
    case "Inspector":
      return "inspector";
      break;
    case "Juez":
      return "judge";
      break;
    case "Administrador":
      return "admin";
      break;
    case "Super admin":
      return "admsuper";
      break;
    case "Municipalidad":
      return "city";
      break;
    case "Conductor":
      return "driver";
      break;
    default:
      return "other";
      break;
  }
}
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
    public function update(Request $request, User $user)
    {
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
            $userUpdate = User::where('id', $user->id)
                        ->update([
                          'password' => bcrypt($request->input('password')),
                        ]);
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

} // function associateVehicle
