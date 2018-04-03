<?php

namespace App\Http\Controllers;

use App\Block;
use App\Cost;
use App\Ticket;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Clase para manejar fechas de laravel


class CreditController
{

  public function index()
  {
    if(Auth::check()){
        return view('credit.index');
    }else{// No esta logeado
      return view('auth.login');
    }
  }
  public function selfLoad()
  {
    if(Auth::check()){
        return view('credit.self');
    }else{// No esta logeado
      return view('auth.login');
    }
  }
  public function checkUser(Request $request){
     $data = (object) $request->json()->all();
    if(Auth::check()){
      if(Auth::user()->type=='local'){// driver
        $user = User::where(['email' => $data->email, 'type' => 'driver'])->first();
        if(sizeof($user)>0){// Chequear si tiene credito
          return response()->json($user);
        }else{
          return response()->json(["error"=>"No se encontró ningún usuario con el mail solicitado"],400);// 400 Bad Request
        }
      }else{
        return response()->json(["error"=>"Sin permiso para buscar usuarios"],403);
      }
    }else{// No esta logeado
      return response()->json(["error"=>"Tiene que estar logueado"],401);
    }
  }
  public function store(Request $request)
  {
    if(Auth::check()){
      if(Auth::user()->type=='local' || (Auth::user()->type=='driver' && $request->input('creditType')=="load")){
        if($request->input('creditAmount') > 0){
          $creditAmount=floatval($request->input('creditAmount'));
          $user=($request->input('creditType')=="sell") ? User::where(['email' => $request->input('creditMail'), 'type' => 'driver'])->first() : Auth::user();// Si es una venta o una recarga
          $creditPayment=($request->input('creditPayment') == "EF")?"credit":"other";
          if(!sizeof($user)>0){// Chequear si el usuario existe
            return response()->json(["error"=>"No se encontró ningún usuario con el mail solicitado"],400);// 400 Bad Request
          }
          if($creditPayment== "credit" && ($creditAmount > (Auth::user()->wallet->balance + Auth::user()->wallet->credit))){// Chequear si tiene credito
            return response()->json(["error"=>"No tiene suficiente crédito como para realizar la venta "],400);// 400 Bad Request
          }
          $generalFunctions = new generalFunctions(); // Instancamos la clase
          // Sumar el saldo a la billetera (wallet) al cliente
          $user->wallet->increment('balance',$creditAmount);
          // grabar operacion del driver
          $saveDriverOperationId = $generalFunctions->operationSave('App/Wallet',$user->id,$creditAmount);
          // generar la factura (bills) y la realcion con la operacion
          $saveBill = $generalFunctions->billSave($creditAmount,'Compra de credito',$saveDriverOperationId);
          if($creditPayment == "credit"){ // Si realiza la venta con credito
            Auth::user()->wallet->decrement('balance',$creditAmount);
            // Tengo que dejar asentado que descuento de la billetera, grabar operacion
            $saveLocalOperationId = $generalFunctions->operationSave('App/Wallet',Auth::user()->wallet->id,($creditAmount * -1));
            // Grabar operacion entre billeteras (operationBetwenWallets)
            $operationBetwenWallets = $generalFunctions->operationBetweenWalletsSave($saveDriverOperationId,$saveLocalOperationId);
          }else{
            // generar venta de la compania (company_sales)
            $companySales = $generalFunctions->companySalesSave(Auth::user()->id,$saveDriverOperationId,'Venta de credito');
          }
          return response()->json(['bill_id'=>$saveBill->id,'amount'=>$creditAmount,'user_name'=>$user->name,'user_wallet'=>$user->wallet->balance]);
        }
      }else{
        return response()->json(["error"=>"Sin permiso para buscar usuarios"],403);
      }
    }else{// No esta logeado
      return response()->json(["error"=>"Tiene que estar logueado"],401);
    }
  }
  public function driverCreditAdd(Request $request){
    if($request->input('amount') > 0){
      echo(Auth::user()->id);
      $generalFunctions = new generalFunctions(); // Instancamos la clase
      // Sumar el saldo a la billetera (wallet) al cliente
      $balance = $generalFunctions->modifyBalanceWallet(Auth::user()->id,$request->input('amount'));
      // grabar operacion del driver
      $saveDriverOperationId = $generalFunctions->operationSave('App/Wallet',Auth::user()->id,$request->input('amount'));
      // generar la factura (bills) y la realcion con la operacion
      $saveBill = $generalFunctions->billSave($request->input('amount'),'Compra de credito',$saveDriverOperationId);
      // generar venta de la compania (company_sales)
      $saveBill = $generalFunctions->companySalesSave(Auth::user()->id,$saveDriverOperationId,'Compra de credito Usuario Registrado');
    }
  }

}
