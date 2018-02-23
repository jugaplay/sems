<?php

namespace App\Http\Controllers;
use App\Bill;
use App\Block;
use App\CompanySale;
use App\Infringement;
use App\InfringementCause;
use App\InfringementDetail;
use App\Operation;
use App\OperationBetweenWallet;
use App\OperationsBill;
use App\Ticket;
use App\Vehicle;
use App\Wallet;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Clase para manejar fechas de laravel



class generalFunctions extends Controller
{
  /***********************************************
  *** Funciones relacionadas con los Blocks ***
  ***********************************************/
  function returnBlockFromLatLng($latLng){
    $pointLocation = new pointLocation(); // Instancamos la clase
    $pointsSearched = $pointLocation->makePoints([$latLng]);// Revisa en un conjunto de puntos, por eso lo paso como arreglo.
    $blocks = Block::all();
    foreach($blocks as $block){
    // Armar el poligono
         $polygon = $pointLocation->makePolygon(json_decode($block->latlng));
         foreach($pointsSearched as $point){ // Mas haya de que sea un solo punto queda asi para verificarlo
             if($pointLocation->pointInPolygon($point, $polygon) > 0){
               return $block;
             }
         }
       }
       return NULL;
  }
  /***********************************
  *** Generar los datos del ticket ***
  ***********************************/
  function dataTicket($plate,$type,$time,$blockId){
    $carbon = new Carbon();

    $local = Auth::user()->local()->get();
    $localData = json_decode($local);

    $cadena = $plate.$type.$time.date('YmdHis');
    $token = substr(str_shuffle($cadena), 0, 10);

    $start = Carbon::now();
    $fin = Carbon::now();

    if($type == 'time'){
        $end = $fin->addHour($time);}
      else {
        $horas = 0;
        $end = substr($start,0,10).' 23:59:59';
      }

    if($type == 'time'){
          $prices = Block::where('id',$blockId)->first()->priceBlockBackEnd('time');
          /*******************************************
          *** Generar el costo del estacionamiento ***
          *******************************************/
          $minutes = ($time * 60); // Se pasa a minutos para poder restar
          $amount = 0;
          $localPrices = json_decode($prices);
          $prices = $localPrices[0];
          foreach ($prices as $minutePrice) {
            if ($minutePrice->price > 0) {
              //echo('$amount = '.$amount.' + '.$minutePrice->price.'  ==> '.$minutePrice->starts.'</br>');
              $amount = $amount + $minutePrice->price;
              $minutes = $minutes - 1;
            }
            if ($minutes <= 0) {
              $endTime = new Carbon($minutePrice->starts);
              break;
            }
          }
          $endTime = $endTime->format('Y-m-d H:i:s');
          $startTime = $start->format('Y-m-d H:i:s');
          $hours = $time;
          $detail = 'Ticket por '.$time.' Horas de estacionamiento desde las '.$startTime.' hasta las '.$endTime.' de la patente '.$plate;
    }
    else
    {
          $hours = 0;
          $detail = 'Ticket por Estadia el dia '.$start.' de la patente '.$plate;

          $prices = Block::where('id',$blockId)->first()->priceBlockBackEnd('day');
          $localPrices = json_decode($prices);
          $price = $localPrices[0];
          $amount = $price[0]->price;
          $endTime = $end;
          $startTime = $start->format('Y-m-d H:i:s');
          //$amount = $localPrices[0]->price;
    }
    $response = array('hours' =>$hours,'start'=>$startTime, 'endTime'=>$endTime,'token'=>$token,'amount'=>$amount,'detail'=>$detail);
    $response = json_encode($response);
    return $response;
  } // fin de dataTicket

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


 /*******************************
 *** Controlar horario ticket ***
 *******************************/
 function controlTicket($plate){
   // desde ==> 2018-02-15 19:18:39
   // Hasta ==> 2018-02-16 09:18:00
   // $endTime = $endTime->format('Y-m-d H:i:s');
   //$startTime = $start->format('Y-m-d H:i:s');
   $carbon = new Carbon();
   $start = Carbon::now();
   $fin = Carbon::now();
   $end = $fin->addMinute(10); // Le agrego 10 minutoa al final por la tolerancia
   $date = date('Y-m-d H:i:s');
   $date = '2018-02-15 19:30:39';
   $ticket = Ticket::where('plate',$plate)
                     ->where('start_time','<=',$start)
                     ->where('end_time','>=',$end)
                    ->first();

   return $ticket;
 }

 /*************************************************
 *** Generar pre infraccion por falta de ticket ***
 *************************************************/
 function preInfringement($plate,$latlng){
   $generalFunctions = new generalFunctions();
   $date = date('Y-m-d H:i:s');
   $dateControl = date('Y-m-d');
   $fin = Carbon::now();
   $end = $fin->addDay(30); // Le agrego 30dias para el pago voluntario
   $end =  $end->format('Y-m-d');
   $infringementCause = InfringementCause::where('id',1)->first();
   $block = $generalFunctions->returnBlockFromLatLng(json_decode($latlng));
   // Verificar que no tenga infracciones del dia de hoy en la misma cuadra.
   echo "control ==> ".$plate.' ==> '.$block->id.' ==> '. $dateControl.'</br>';
   $infringementExist =Infringement::where('plate',$plate)
                                   ->where('block_id',$block->id)
                                   ->where('date','=', $dateControl)->first();

   //dd($infringementExist);
   if(!$infringementExist){ // Si no existe generar infraccion
      $infringement=Infringement::create([
        'plate'                    => $plate,
        'user_id'                  => Auth::user()->id,
        'date'                     => $date,
        'situation'                => 'before', //(before/saved/voluntary/judge/close)
        'infringement_cause_id'    => '1',
        'cost'                     => $infringementCause->cost,
        'voluntary_cost'           => $infringementCause->voluntary_cost,
        'voluntary_end_date'       => $end,
        'latlng'                   => $latlng,
        'block_id'                 => $block->id,
      ]);
      $infringementDetail=InfringementDetail::create([
        'user_id'          => Auth::user()->id,
        'infringement_id'  => $infringement->id,
        'detail'           => 'No tiene ticket. Controlado por inspector',
      ]);
      echo "Infraccion generada";
    }else{echo "Ya tiene infraccion para el dia de hoy y esta cuadra";}
 }

 // Actualizar las infracciones
 function infringementsUpdate($infringementId,$situation,$detail,$close_date,$close_cost){
   $Infringement = Infringement::where('id', $infringementId)
           ->update([
             'situation'  => $situation, //(before/saved/voluntary/judge/close)
             'close_date' => $close_date, //(before/saved/voluntary/judge/close)
             'close_cost' => $close_cost, //(before/saved/voluntary/judge/close)
              ]);

   $infringementDetail=InfringementDetail::create([
                   'user_id'          => Auth::user()->id,
                   'infringement_id'  => $infringementId,
                   'detail'           => $detail,
                    ]);

 }

} // fin de la clase
