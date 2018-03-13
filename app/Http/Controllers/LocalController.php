<?php

namespace App\Http\Controllers;

use App\Area;
use App\Block;
use App\Bill;
use App\Cost;
use App\CompanySale;
use App\Local;
use App\Operation;
use App\OperationsBill;
use App\Ticket;
use App\User;
use App\Vehicle;
use App\Wallet;

use App\UsersBillingData;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Clase para manejar fechas de laravel

function parseAccountStatus($status){
  switch ($status) {
    case 'C':
      return "Confirmada";
      break;
    case 'N':
      return "No confirmada";
      break;
    case 'B':
      return "Baja";
      break;
    default:
      return "Otro";
      break;
  }
}
function parseInverseAccountStatus($status){
  switch ($status) {
    case 'Confirmada':
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
function parseVerified($verified){
  return ($verified==1) ? "Verificada" : "No verificada";
}
function parseInverseVerified($verified){
  return ($verified=="Verificada") ? 1 : 0;
}
function parseTaxTreatment($tax){
  switch ($tax) {
    case 1:
      return "Inscripto";
      break;
    case 6:
      return "Monotributo";
      break;
    default:// seria el 5
      return "Consumidor final";
      break;
  }
}
function parseInverseTaxTreatment($tax){
  switch ($tax) {
    case "Inscripto":
      return 1;
      break;
    case "Monotributo":
      return 61;
      break;
    default:
      return 5;// Consumidor final
      break;
  }
}
function parseDocumentType($document){
  switch ($document) {
    case 80:
      return "CUIT";
      break;
    case 86:
      return "CUIL";
      break;
    case 96:
      return "DNI";
      break;
    default:
      return "";
      break;
  }
}
function parseInverseDocumentType($document){
  switch ($document) {
    case "CUIT":
      return 80;
      break;
    case "CUIL":
      return 86;
      break;
    case "DNI":
      return 96;
      break;
    default:
      return 0;
      break;
  }
}
class LocalController extends Controller
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
      return view('locals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('locals.create');
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
          $generalFunctions = new generalFunctions();
          $latLng=[$request->input('createLatitud'),$request->input('createLongitud')];
          $block=$generalFunctions->returnBlockFromLatLng($latLng);
          if(is_null($block)){// No se encontro ningun block en el area
            return response()->json(["error"=>"El punto no pertenece a ninguna cuadra cargada"],400);
          }
          // Grabo Usuario
          $user=User::create([
          'name' => $request->input('createName'),
          'email' => $request->input('createMail'),
          'phone' => $request->input('createPhone'),
          'type' => 'local',
          'account_status' => parseInverseAccountStatus($request->input('createAccountStatus')),
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
           $userBillingData=UsersBillingData::create([
                'user_id'         => $id_user,
                'bussines_name'   => $request->input('createBussinesName'),
                'tax_treatment'   => parseInverseTaxTreatment($request->input('createTaxTreatment')),
                'address'         => $request->input('createBillingAddress'),
                'city'            => $request->input('createBillingCity'),
                'state'           => $request->input('createBillingState'),
                'document_type'   => parseInverseDocumentType($request->input('createDocumentType')),
                'document_number' => $request->input('createDocumentNumber'),
                 ]);
           if(!$userBillingData->save()){
             return response()->json(["error"=>"Error creando los datos de Facturación en la base de datos"],422);
           }
           // Genera datos local
           $userLocal=Local::create([
              'user_id'    => $id_user,
              'latlng'     => json_encode($latLng),
              'fee'        => $request->input('createFee'),       //(default es 0)
              'verified'   => parseInverseVerified($request->input('createAccountVerified')),
              'block_id'   => $block->id,
              'address'    => $request->input('createAddres'),
            ]);
          if(!$userLocal->save()){
            return response()->json(["error"=>"Error creando el local en la base de datos"],422);
          }
          // Fin grabo y devulvo algunos datos del usuario
          return response()->json($user);
        }else{
          // No tiene permiso para esta accion
          return response()->json(["error"=>"Sin permiso para crear un local"],403);
        }
      }else{// Tiene que hacer el login primero
        return response()->json(["error"=>"Tiene que estar logueado"],401);
      }
    } // Fin del store


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
      $locals = User::where('type','local')->get();
      $arrOfLocals=array();
      foreach ($locals as $local) {
        $localDetail=$local->local()->first();
        $localBillingData=$local->userbillingdata()->first();
        $latLng=json_decode($localDetail->latlng);
        array_push($arrOfLocals,[
          $local->name,
          $local->email,
          $localDetail->address,
          $local->phone,
          parseAccountStatus($local->account_status),
          parseVerified($localDetail->verified),
          $local->id,
          $latLng[0],
          $latLng[1],
          $localDetail->fee,
          $localBillingData->bussines_name,
          parseTaxTreatment($localBillingData->tax_treatment),
          $localBillingData->address,
          $localBillingData->city,
          $localBillingData->state,
          parseDocumentType($localBillingData->document_type),
          $localBillingData->document_number
          ]);
      }
      return response()->json([
          'aaData' => $arrOfLocals
      ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($local_id=null)
    {
        $user = User::where('id', $local_id)->first();
        //$wallet = $user->wallet()->get();
        //dump($user);
        //dd($wallet);
      return view('locals.edit',['user'=>$user]);
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
          $user= User::where('id',$request->input('userId'))->first();
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
          $generalFunctions = new generalFunctions();
          $latLng=[$request->input('editLatitud'),$request->input('editLongitud')];
          $block=$generalFunctions->returnBlockFromLatLng($latLng);
          if(is_null($block)){// No se encontro ningun block en el area
            return response()->json(["error"=>"El punto no pertenece a ninguna cuadra cargada"],400);
          }
          $userUpdate = User::where('id', $user->id)
                      ->update([
                        'name' => $request->input('editName'),
                        'email' => $request->input('editMail'),
                        'phone' => $request->input('editPhone'),
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
          $usersBillingDataUpdate = UsersBillingData::where('user_id', $user->id)
                      ->update([
                        'bussines_name'   => $request->input('editBussinesName'),
                        'tax_treatment'   => parseInverseTaxTreatment($request->input('editTaxTreatment')),
                        'address'         => $request->input('editBillingAddress'),
                        'city'            => $request->input('editBillingCity'),
                        'state'           => $request->input('editBillingState'),
                        'document_type'   => parseInverseDocumentType($request->input('editDocumentType')),
                        'document_number' => $request->input('editDocumentNumber'),
                      ]);
          if(!$usersBillingDataUpdate){
            return response()->json(["error"=>"Error actualizando los datos de Facturación del local en la base de datos"],422);
          }
          $localUpdate = Local::where('id', $user->local()->first()->id)
                      ->update([
                        'latlng'     => json_encode($latLng),
                        'fee'        => $request->input('editFee'),       //(default es 0)
                        'verified'   => parseInverseVerified($request->input('editAccountVerified')),
                        'block_id'   => $block->id,
                        'address'    => $request->input('editAddres'),
                      ]);
          if(!$localUpdate){
            return response()->json(["error"=>"Error actualizando los datos del local en la base de datos"],422);
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

    } // Fin funcion update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $findLocal = Local::find( $user->id);
        if($findLocal->delete()){
                //redirect
                return redirect()->route('locals.index')
                ->with('success' , 'Local deleted successfully');
            }
    }

    public function delete($local_id=null)
    {
        //
        $user = User::where('id', $local_id)->first();
        $usersBillingData=UsersBillingData::where('user_id', $local_id)->first();
        $wallet=Wallet::where('user_id', $local_id)->first();
        return view('locals.delete',['user'=>$user,'usersBillingData'=>$usersBillingData,'wallet'=>$wallet]);//->with($findProject);

    }

    public function localTicket()
    {
        //
        $local = Auth::user()->local()->get();

        $localData = json_decode($local);
        $timeNow = date('Y-m-d H:i:s');
        $priceTime = Block::where('id',$localData[0]->block_id)->first()->priceBlock('time');
        $priceDay = Block::where('id',$localData[0]->block_id)->first()->priceBlock('day');

       return view('locals.ticket',['priceTime'=>$priceTime,'priceDay'=>$priceDay]);
    }

    public function localTicketCreate(Request $request){

      $carbon = new Carbon();

      $local = Auth::user()->local()->get();
      $localData = json_decode($local);

      $cadena = $request->input('plate').$request->input('type').$request->input('time').date('YmdHis');
      $token = substr(str_shuffle($cadena), 0, 10);

      $start = Carbon::now('America/Argentina/Buenos_Aires');
      $fin = Carbon::now('America/Argentina/Buenos_Aires');

      if($request->input('type') == 'time'){
          $end = $fin->addHour($request->input('time'));}
        else {
          $horas = 0;
          $end = substr($start,0,10).' 23:59:59';
        }

      if($request->input('type') == 'time'){
            $prices = Block::where('id',$localData[0]->block_id)->first()->priceBlockBackEnd('time');
            /*******************************************
            *** Generar el costo del estacionamiento ***
            *******************************************/
            $minutes = ($request->input('time') * 60); // Se pasa a minutos para poder restar
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
            $hours = $request->input('time');
            $detail = 'Ticket por '.$request->input('time').' Horas de estacionamiento desde las '.$start.' hasta las '.$endTime.' de la patente '.$request->input('plate');
      }
      else
      {
            $hours = 0;
            $detail = 'Ticket por Estadia el dia '.$start.' de la patente '.$request->input('plate');

            $prices = Block::where('id',$localData[0]->block_id)->first()->priceBlockBackEnd('day');
            $localPrices = json_decode($prices);
            $price = $localPrices[0];
            $amount = $price[0]->price;
            $endTime = $end;
            //$amount = $localPrices[0]->price;
      }
          /***********************************
          *** Grabar todas las operaciones ***
          ***********************************/
          $generalFunctions = new generalFunctions(); // Instancamos la clase
         // Grabar el ticket
          $ticketId = $generalFunctions->ticketSave(Auth::user()->id,$request->input('plate'),$hours,$start,$endTime,
                                                    $localData[0]->block_id,$localData[0]->latlng,$token,$request->input('type'));
          // grabar operacion
          $saveOperationId = $generalFunctions->operationSave('Ticket',$ticketId,($amount *-1));
          // Actualizar el ticket con el id de la operacion.
          Ticket::where('id', $ticketId)->update(['operation_id' => $saveOperationId]);
          // generar venta de la compania (company_sales)
          $saveBill = $generalFunctions->companySalesSave(Auth::user()->id,$saveOperationId,$detail);
          // generar la factura (bills) y la realcion con la operacion
          $saveBill = $generalFunctions->billSave($amount,$detail,$saveOperationId);
          // restar el saldo a la billetera (wallet) del local
          $balance = $generalFunctions->modifyBalanceWallet(Auth::user()->id,($amount * -1));
          // Registrar la patente si no existe
          $vehicle_id = $generalFunctions->registerVehicle($request->input('plate'));

    }// fin funcion de ticketCreate

    public function localCredit()
    {
        //
        //$local = Auth::user()->local()->get();
        //$localData = json_decode($local);
        $drivers = User::where('type', 'driver')->orderBy('name')->get();
        //dd($drivers);
       return view('locals.credit',['drivers'=>$drivers]);
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
    }

}  // Fin de la clase
