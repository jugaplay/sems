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
    return view('tickets.index');
  }

  public function show(User $user)
  {
      //
  }

  public function localTicket()
  {
      $local = Auth::user()->local()->get();
      $localData = json_decode($local);
      $timeNow = date('Y-m-d H:i:s');
      $priceTime = Block::where('id',$localData[0]->block_id)->first()->priceBlock('time');
      $priceDay = Block::where('id',$localData[0]->block_id)->first()->priceBlock('day');

     return view('tickets.localticket',['priceTime'=>$priceTime,'priceDay'=>$priceDay]);
  }

  public function localTicketCreate(Request $request){

        $local = Auth::user()->local()->get();
        $localData = json_decode($local);

        $generalFunctions = new generalFunctions(); // Instancamos la clase

        // Generar el costo y los dartos del ticket o la estadia
        $dataTicket = $generalFunctions->dataTicket($request->input('plate'),$request->input('type'),$request->input('time'),$localData[0]->block_id);
        $dataTicket = json_decode($dataTicket);
        //dd($dataTicket);
        /***********************************
        *** Grabar todas las operaciones ***
        ***********************************/
       // Grabar el ticket
        $ticketId = $generalFunctions->ticketSave(Auth::user()->id,$request->input('plate'),$dataTicket->hours,$dataTicket->start,
                                                  $dataTicket->endTime,$localData[0]->block_id,$localData[0]->latlng,
                                                  $dataTicket->token,$request->input('type'));
        // grabar operacion
        $saveOperationId = $generalFunctions->operationSave('Ticket',$ticketId,($dataTicket->amount *-1));
        // Actualizar el ticket con el id de la operacion.
        Ticket::where('id', $ticketId)->update(['operation_id' => $saveOperationId]);
        // generar venta de la compania (company_sales)
        $saveBill = $generalFunctions->companySalesSave(Auth::user()->id,$saveOperationId,$dataTicket->detail);
        // generar la factura (bills) y la realcion con la operacion
        $saveBill = $generalFunctions->billSave($dataTicket->amount,$dataTicket->detail,$saveOperationId);
        // restar el saldo a la billetera (wallet) del local
        $balance = $generalFunctions->modifyBalanceWallet(Auth::user()->id,($dataTicket->amount * -1));
        // Registrar la patente si no existe
        $vehicle_id = $generalFunctions->registerVehicle($request->input('plate'));

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
      $saveDriverOperationId = $generalFunctions->operationSave('wallet',$request->input('user_id'),$request->input('amount'));
      // restar el saldo a la billetera (wallet) del local
      $balance = $generalFunctions->modifyBalanceWallet(Auth::user()->id,($request->input('amount') * -1));
      // grabar operacion del local
      $saveLocalOperationId = $generalFunctions->operationSave('wallet',Auth::user()->id,($request->input('amount') * -1));
      // Grabar operacion entre billeteras (operationBetwenWallets)
      $operationBetwenWallets = $generalFunctions->operationBetweenWalletsSave($saveDriverOperationId,$saveLocalOperationId);
      // generar la factura (bills) y la realcion con la operacion
      $saveBill = $generalFunctions->billSave($request->input('amount'),'Compra de credito',$saveDriverOperationId);
      // generar venta de la compania (company_sales)
      $saveBill = $generalFunctions->companySalesSave(Auth::user()->id,$saveDriverOperationId,'Venta de credito');
    }
  } // Fin de localCreditAdd

  public function driverTicket()
  {
      return view('tickets.driverticket',['user'=>Auth::user()]);
  }

  public function driverTicketCreate(Request $request){

        $generalFunctions = new generalFunctions(); // Instancamos la clase
        echo "LatLng = ".$request->input('latlng').'</br>';
        $block = $generalFunctions->returnBlockFromLatLng(json_decode($request->input('latlng')));
        if(!$block){echo "No existe el block";return;}
        //dd($block);
        // Generar el costo y los dartos del ticket o la estadia
        $dataTicket = $generalFunctions->dataTicket($request->input('plate'),$request->input('type'),$request->input('time'),$block->id);
        $dataTicket = json_decode($dataTicket);
        //dd($dataTicket);
        /***********************************
        *** Grabar todas las operaciones ***
        ***********************************/
       // Grabar el ticket
        $ticketId = $generalFunctions->ticketSave(Auth::user()->id,$request->input('plate'),$dataTicket->hours,$dataTicket->start,
                                                  $dataTicket->endTime,$block->id,$request->input('latlng'),
                                                  $dataTicket->token,$request->input('type'));
        // grabar operacion
        $saveOperationId = $generalFunctions->operationSave('Ticket',$ticketId,($dataTicket->amount *-1));
        // Actualizar el ticket con el id de la operacion.
        Ticket::where('id', $ticketId)->update(['operation_id' => $saveOperationId]);
        // generar venta de la compania (company_sales)
        $saveBill = $generalFunctions->companySalesSave(Auth::user()->id,$saveOperationId,$dataTicket->detail);
        // generar la factura (bills) y la realcion con la operacion
        $saveBill = $generalFunctions->billSave($dataTicket->amount,$dataTicket->detail,$saveOperationId);
        // restar el saldo a la billetera (wallet) del conductor
        $balance = $generalFunctions->modifyBalanceWallet(Auth::user()->id,($dataTicket->amount * -1));
        // Registrar la patente si no existe
        $vehicle_id = $generalFunctions->registerVehicle($request->input('plate'));

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
      $saveDriverOperationId = $generalFunctions->operationSave('wallet',Auth::user()->id,$request->input('amount'));
      // generar la factura (bills) y la realcion con la operacion
      $saveBill = $generalFunctions->billSave($request->input('amount'),'Compra de credito',$saveDriverOperationId);
      // generar venta de la compania (company_sales)
      $saveBill = $generalFunctions->companySalesSave(Auth::user()->id,$saveDriverOperationId,'Compra de credito Usuario Registrado');
    }
  } // Fin de localCreditAdd


}
