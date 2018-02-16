<?php

namespace App\Http\Controllers;
use App\Bill;
use App\CompanySale;
use App\ExeptuatedVehicle;
use App\Operation;
use App\OperationBetweenWallet;
use App\OperationsBill;
use App\Ticket;
use App\Vehicle;
use App\Wallet;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class generalFunctions extends Controller
{

  /***********************************************
  *** Funciones relacionadas con los vehiculos ***
  ***********************************************/
  function registerVehicle($plate)
  {
    //Verificar si el vehiculo existe en la base.
    $VehicleExist = Vehicle::where('plate', $plate)->first();
    if (!$VehicleExist) {
      # grabar el vehiculo en la tabla
      $vehicle=Vehicle::create([
        'plate' => $plate,
      ]);
      $id_vehiculo = $vehicle->id;
    }else {
      $id_vehiculo = $VehicleExist->id;    }

    return   $id_vehiculo;
  }

  /********************************************
  *** Funciones relacionadas con los wallet ***
  ********************************************/
  function modifyBalanceWallet($user,$amount){
    # se debera pasar el usaurio ($user) y el importe
    # ($amount) con el signo correspondiente.
    $walletExist = Wallet::where('user_id',$user)->first();
    $newBalance = $walletExist->balance + $amount;
    $updateWallet = Wallet::where('user_id',$user)
                            ->update(['balance'=>$newBalance]);
    return $newBalance;
    }

    /*************************
    *** Grabar  operacion  ***
    *************************/
    function operationSave($type,$type_id,$amount){
    $operation = Operation::create([
       'type'    => $type, //(wallet/ticket/infringement)
       'type_id' => $type_id,
       'amount'  => $amount,
     ]);
     return $operation->id;
   }

   /*************************
   *** Grabar  operacion  ***
   *************************/
   function operationBetweenWalletsSave($operation_1,$operation_2){
   # primero el id de la operacion que suma ($operation_1) y segundo el id de la operacion que resta ($operation_2).
   $operation = OperationBetweenWallet::create([
      'operation_id_1'  => $operation_1,
      'operation_id_2'  => $operation_2,
    ]);
    return $operation->id;
  }
  /***************************
  *** Grabar company sale  ***
  ***************************/
  function companySalesSave($user,$operation_id,$detail){
  # primero el id de la operacion que suma ($operation_1) y segundo el id de la operacion que resta ($operation_2).
  $operation = CompanySale::create([
    'user_id'       => $user,
    'operation_id'  => $operation_id,
    'detail'        => $detail,
   ]);
   return $operation->id;
 }


  /*******************************
  *** Grabar la factura (bill) ***
  *******************************/
  function billSave($amount,$detail,$operationsBillIs){
      $billsExist = Bill::all()->last();
      if(!$billsExist) {
        $next_bill = 1;
      }else {
        $next_bill = $billsExist->id + 1;
      }
        $net = $amount /1.21;
        $iva = ($net * 21) / 100;
        $billCreate=Bill::create([
            'type'            => 'F',
            'letter'          => 'B',
            'branch_office'   => '0001',
            'number'          => $next_bill,
            'document_type'   => '99', // Consumidor final
            'document_number' => '0',
            'net'             => $net,
            'iva'             => $iva,
            'total'           => $amount,
            'date'            => date('Y-m-d'),
            'detail'          => $detail,
            ]);
          $operationBil = OperationsBill::create([
            'operation_id' => $operationsBillIs,
            'bill_id'      => $billCreate->id,
          ]);
  }

  /************************
  *** Generar el ticket ***
  ************************/
  function ticketSave($user,$plate,$hours,$stars,$endTime,$block,$latlng,$token,$type){
    $ticket=Ticket::create([
      'user_id'    => $user,
      'plate'      => $plate,
      'time'       => $hours,
      'start_time' => $stars,
      'end_time'   => $endTime,
      'block_id'   => $block,
      'latlng'     => $latlng,
      'token'      => $token,
      'type'       => $type, //(time/day)
    ]);
    return $ticket->id;
  }

  /******************************************
  *** Grabar la tabla exeptuated_vehicles ***
  ******************************************/
  function exeptuatedVehiclesSave($vehicleId,$detail,$start_time,$end_time,$latlng,$exeptuatedCauseId){
    $exeptuatedVehicle = ExeptuatedVehicle::create([
        'vehicle_id'          => $vehicleId,
        'detail'              => $detail,
        'start_time'          => $start_time,
        'end_time'            => $end_time,
        'latlng'              => $latlng,
        'exeptuated_cause_id' => $exeptuatedCauseId,
      ]);
   return $exeptuatedVehicle->id;
  }



} // fin de la clase
