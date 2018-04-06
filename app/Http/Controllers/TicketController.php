<?php

namespace App\Http\Controllers;

use App\Block;
use App\Cost;
use App\Ticket;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Clase para manejar fechas de laravel


class TicketController
{

  public function index()
  {
    if(Auth::check()){
      if(Auth::user()->type=='local'){
        $timeNow = date('Y-m-d H:i:s');
        $priceTime = Block::where('id',Auth::user()->local->block_id)->first()->priceBlock('time'); // Tengo que hacer un parse a al horario de javascript
        $priceDay = Block::where('id',Auth::user()->local->block_id)->first()->priceBlock('day');
        return view('tickets.index',['priceTime'=>$priceTime,'priceDay'=>$priceDay]);
      }else{
        return view('tickets.index');
      }
    }else{// No esta logeado
      return view('auth.login');
    }
  }

  public function show(User $user)
  {
      //
  }

  public function localTicket()
  {
      $timeNow = date('Y-m-d H:i:s');
      $priceTime = Block::where('id',Auth::user()->local->block_id)->first()->priceBlock('time');
      $priceDay = Block::where('id',Auth::user()->local->block_id)->first()->priceBlock('day');

     return view('tickets.localticket',['priceTime'=>$priceTime,'priceDay'=>$priceDay]);
  }

  public function localTicketCreate(Request $request){
        // Verifico si es con credito y en caso de serlo, si tiene, el otro lo genera por detras?
        if(Auth::check()){
          if(Auth::user()->type=="local" && Auth::user()->account_status!="B" ){
            $block_id=Auth::user()->local->block_id;
            $latlng=Auth::user()->local->latlng;
            $generalFunctions = new generalFunctions(); // Instancamos la clase
            $ticketPayment=($request->input('ticketPayment') == "EF")?"credit":"other";
            // Generar el costo y los dartos del ticket o la estadia
            $ticketType=($request->input('ticketDay') == 'true')?"day":"time";
            $minutes=$request->input('ticketHours')*60;
            $dataTicket = $generalFunctions->dataTicket($request->input('ticketPlate'),$ticketType,$minutes,$block_id);
            //return response()->json($dataTicket->amount);
            if($ticketPayment== "credit" && ($dataTicket->amount > (Auth::user()->wallet->balance + Auth::user()->wallet->credit))){// Chequear si tiene credito
              return response()->json(["error"=>"No tiene suficiente crédito como para realizar la compra "],400);// 400 Bad Request
            }
            //dd($dataTicket);
            /***********************************
            *** Grabar todas las operaciones ***
            ***********************************/
           // Grabar el ticket
            $ticket = $generalFunctions->ticketSave(Auth::user()->id,strtoupper($request->input('ticketPlate')),$dataTicket->hours,$dataTicket->start,
                                                      $dataTicket->endTime,$block_id,$latlng,
                                                      $dataTicket->token,$ticketType);
            // grabar operacion
            $saveOperationId = $generalFunctions->operationSave('App\Ticket',$ticket->id,($dataTicket->amount *-1));
            // Actualizar el ticket con el id de la operacion.
            //Ticket::where('id', $ticketId)->update(['operation_id' => $saveOperationId]);
            $ticket->update(['operation_id' => $saveOperationId]);
            // generar la factura (bills) y la realcion con la operacion
            $saveBill = $generalFunctions->billSave($dataTicket->amount,$dataTicket->detail,$saveOperationId);
            // restar el saldo a la billetera (wallet) del local
            if($ticketPayment== "credit"){
              Auth::user()->wallet->decrement('balance',$dataTicket->amount);
              // Tengo que dejar asentado que descuento de la billetera, grabar operacion
              $walletOperationId = $generalFunctions->operationSave('App\Wallet',Auth::user()->wallet->id,($dataTicket->amount* -1));
            }else{
              // generar venta de la compania (company_sales)
              $companySales = $generalFunctions->companySalesSave(Auth::user()->id,$saveOperationId,$dataTicket->detail);
            }
            // Registrar la patente si no existe
            $vehicle_id = $generalFunctions->registerVehicle($request->input('ticketPlate'));
            $ticket['bill']=$saveBill;
            return response()->json($ticket);
          }else{
            // No tiene permiso para esta accion
            return response()->json(["error"=>"Sin permiso para crear un ticket"],403);
          }
        }else{// Tiene que hacer el login primero
          return response()->json(["error"=>"Tiene que estar logueado"],401);
        }


  }// fin funcion de localTicketCreate

  public function localCredit()
  {
      //
      $drivers = User::where('type', 'driver')->orderBy('name')->get();
      return view('tickets.localcredit',['drivers'=>$drivers]);
  } // Fin de la funcion de localCredit


  /********************************
  *** graba el credito cargado  ***
  ********************************/
  public function localCreditAdd(Request $request){
    if($request->input('amount') > 0){
      $generalFunctions = new generalFunctions(); // Instancamos la clase
      // Sumar el saldo a la billetera (wallet) al cliente
      $balance = $generalFunctions->modifyBalanceWallet($request->input('user_id'),$request->input('amount'));
      // grabar operacion del driver
      $saveDriverOperationId = $generalFunctions->operationSave('App\Wallet',$request->input('user_id'),$request->input('amount'));
      // restar el saldo a la billetera (wallet) del local
      $balance = $generalFunctions->modifyBalanceWallet(Auth::user()->id,($request->input('amount') * -1));
      // grabar operacion del local
      $saveLocalOperationId = $generalFunctions->operationSave('App\Wallet',Auth::user()->id,($request->input('amount') * -1));
      // Grabar operacion entre billeteras (operationBetwenWallets)
      $operationBetwenWallets = $generalFunctions->operationBetweenWalletsSave($saveDriverOperationId,$saveLocalOperationId);
      // generar la factura (bills) y la realcion con la operacion
      $saveBill = $generalFunctions->billSave($request->input('amount'),'Compra de credito',$saveDriverOperationId);
      // generar venta de la compania (company_sales)
      $saveBill = $generalFunctions->companySalesSave(Auth::user()->id,$saveDriverOperationId,'Venta de credito');
    }
  } // Fin de localCreditAdd

  public function driverTicket(Request $request)
  {
    // En el request le tengo que mandar el LatLng
    // Busca el bloque, sino busca el mas cercano!
    // Lo llamo strong search
    $generalFunctions = new generalFunctions();
    $block=$generalFunctions->returnForcedBlockFromLatLng(json_decode($request->input('latlng')));// Si o si devuelve un bloque
    $priceTime = $block->priceBlock('time');
    $priceDay = $block->priceBlock('day');
    if(Auth::check()){
      if(Auth::user()->type=='driver'){
        $ownedCars=Auth::user()->vehicles()->get()->transform(function($objet,$key){
          return $objet->plate;
        });
        return view('tickets.index',['priceTime'=>$priceTime,'priceDay'=>$priceDay,'ownedCars'=>$ownedCars,'block_id'=>$block->id]);
      }else{
        return view('tickets.index');
      }
    }else{// No esta logeado
      return view('tickets.index',['priceTime'=>$priceTime,'priceDay'=>$priceDay,'block_id'=>$block->id]);
    }
      //return view('tickets.driverticket',['user'=>Auth::user()]);
  }

  public function driverTicketCreate(Request $request){
    // Verifico si es con credito y en caso de serlo, si tiene, el otro lo genera por detras?
    if(Auth::check()){
      if(Auth::user()->type=="driver" && Auth::user()->account_status!="B" ){
        $block_id=$request->input('blockId');
        $latlng=$request->input('latlng');
        $generalFunctions = new generalFunctions(); // Instancamos la clase
        $ticketPayment=($request->input('ticketPayment') == "EF")?"credit":"other";
        // Generar el costo y los dartos del ticket o la estadia
        $ticketType=($request->input('ticketDay') == 'true')?"day":"time";
        $minutes=$request->input('ticketHours')*60;
        $dataTicket = $generalFunctions->dataTicket($request->input('ticketPlate'),$ticketType,$minutes,$block_id);
        //return response()->json($dataTicket->amount);
        if($ticketPayment== "credit" && ($dataTicket->amount > (Auth::user()->wallet->balance + Auth::user()->wallet->credit))){// Chequear si tiene credito
          return response()->json(["error"=>"No tiene suficiente crédito como para realizar la compra "],400);// 400 Bad Request
        }
        //dd($dataTicket);
        /***********************************
        *** Grabar todas las operaciones ***
        ***********************************/
       // Grabar el ticket
        $ticket = $generalFunctions->ticketSave(Auth::user()->id,strtoupper($request->input('ticketPlate')),$dataTicket->hours,$dataTicket->start,
                                                  $dataTicket->endTime,$block_id,$latlng,
                                                  $dataTicket->token,$ticketType);
        // grabar operacion
        $saveOperationId = $generalFunctions->operationSave('App\Ticket',$ticket->id,($dataTicket->amount *-1));
        // Actualizar el ticket con el id de la operacion.
        //Ticket::where('id', $ticketId)->update(['operation_id' => $saveOperationId]);
        $ticket->update(['operation_id' => $saveOperationId]);
        // generar la factura (bills) y la realcion con la operacion
        $saveBill = $generalFunctions->billSave($dataTicket->amount,$dataTicket->detail,$saveOperationId);
        // restar el saldo a la billetera (wallet) del local
        if($ticketPayment== "credit"){
          Auth::user()->wallet->decrement('balance',$dataTicket->amount);
          // Tengo que dejar asentado que descuento de la billetera, grabar operacion
          $walletOperationId = $generalFunctions->operationSave('App\Wallet',Auth::user()->wallet->id,($dataTicket->amount* -1));
        }else{
          // generar venta de la compania (company_sales)
          $companySales = $generalFunctions->companySalesSave(Auth::user()->id,$saveOperationId,$dataTicket->detail);
        }
        // Registrar la patente si no existe
        $vehicle_id = $generalFunctions->registerVehicle($request->input('ticketPlate'));
        if($request->input('saveCar')=="true"){// Si lo tiene para gurdar como propio
          Auth::user()->vehicles()->attach($vehicle_id); // El contrario es $user->roles()->detach(1);
        }
        $ticket['bill']=$saveBill;
        return response()->json($ticket);
      }else{
        // No tiene permiso para esta accion
        return response()->json(["error"=>"Sin permiso para crear un ticket"],403);
      }
    }else{// Tiene que hacer el login primero
      return response()->json(["error"=>"Tiene que estar logueado"],401);
    }
  }// fin funcion de driverTicketCreate

  public function driverCredit()
  {
      return view('tickets.drivercredit',['user'=>Auth::user()]);
  }

  /********************************
  *** graba el credito cargado  ***
  ********************************/
  public function driverCreditAdd(Request $request){
    if($request->input('amount') > 0){
      echo(Auth::user()->id);
      $generalFunctions = new generalFunctions(); // Instancamos la clase
      // Sumar el saldo a la billetera (wallet) al cliente
      $balance = $generalFunctions->modifyBalanceWallet(Auth::user()->id,$request->input('amount'));
      // grabar operacion del driver
      $saveDriverOperationId = $generalFunctions->operationSave('App\Wallet',Auth::user()->id,$request->input('amount'));
      // generar la factura (bills) y la realcion con la operacion
      $saveBill = $generalFunctions->billSave($request->input('amount'),'Compra de credito',$saveDriverOperationId);
      // generar venta de la compania (company_sales)
      $saveBill = $generalFunctions->companySalesSave(Auth::user()->id,$saveDriverOperationId,'Compra de credito Usuario Registrado');
    }
  } // Fin de localCreditAdd

  public function controlParking(Request $request)
  {
    $data = (object) $request->json()->all();// {"plate":plate,"latlng":latlng}
    $data->plate=strtoupper($data->plate);
    $generalFunctions = new generalFunctions(); // Instancamos la clase
    if(Auth::check()){
      if(Auth::user()->type=="inspector" && Auth::user()->account_status!="B" ){
        $block=$generalFunctions->returnBlockFromLatLng($data->latlng);
        if($block==NULL){
          return response()->json(["error"=>"El lugar en donde se encuentra no pertenece a  la zona habilitada para controlar estacionamiento. "],400);// 400 Bad Request
        }
        $ticket = $generalFunctions->controlTicket($data->plate);
        if(!$ticket){// Ticket solo no se puede
          if($block->timePriceNow()>0){// Revisa que tenga que cobrar algo
              registerVehicle($data->plate);// Si no existe el vehiculo lo creo
              $infringement= $generalFunctions->preInfringement($data->plate,$data->latlng);
              return response()->json($infringement);
          }else{
            return response()->json(["error"=>"El costo actual de esta cuadra es de $0 "]);
          }
        }else {
          $ticket->update(['latlng'=>json_encode($data->latlng),'block_id'=>$block->id,'check'=>Auth::user()->id]);
          return response()->json(['ticket'=>$ticket]);
        }
      }else{
        // No tiene permiso para esta accion
        return response()->json(["error"=>"Sin permiso para comprobar una patente"],403);
      }
    }else{// Tiene que hacer el login primero
      return response()->json(["error"=>"Tiene que estar logueado"],401);
    }
  }

}
