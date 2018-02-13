<?php

namespace App\Http\Controllers;

use App\User;
use App\Wallet;
use App\Vehicle;
use App\VehicleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
      // Alta de usuarios
      if (empty($request->input('password'))) {
          //$responseUserExist = json_decode($userExist);
          echo "La clave no puede estar vacia ";
          return;
      }

      if (empty($request->input('email'))) {
          //$responseUserExist = json_decode($userExist);
          echo "El mail es obligatorio ";
          return;
      }

      $userExist = User::where('email', $request->input('email'))->get();
      if (count($userExist) > 0) {
          //$responseUserExist = json_decode($userExist);
          echo "Mail ya existe => ".$userExist;
          return;
      }

      if(Auth::check()){
        $user=User::create([
          'name' => $request->input('name'),
          'email' => $request->input('email'),
          'phone' => $request->input('phone'),
          'type' => $request->input('type'),
          'account_status' => $request->input('account_status'),
          'password' => bcrypt($request->input('password')),
        //'--
        ]);
        $id_user = $user->id; // Retorna el id del insert ejecutado
        echo "Usuarios creado =>".$id_user. "\n" ;
        $types = array('local','driver','assistant');
        if (in_array($request->input('type'), $types)) {
          // Generar una wallets
          $user=Wallet::create([
            'user_id' => $id_user,
            'balance' => 0,
            'chips'   => 0,
            'credit'  => 0,
            ]);
            echo "Billetera creada =>".$id_user. "\n" ;
        }
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
        //
        if(Auth::check()){
          $user=User::where('id', $user->id)
          ->update([
            'name'    => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            //'password' => bcrypt($request->input('password')),
          ]);
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
