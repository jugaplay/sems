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
use App\Wallet;

use App\UsersBillingData;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Clase para manejar fechas de laravel

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
          'name' => $request->input('bussines_name'),
          'email' => $request->input('email'),
          'phone' => $request->input('phone'),
          'type' => $request->input('type'),
          'account_status' => $request->input('account_status'),
          'password' => bcrypt($request->input('password')),
        ]);
        $id_user = $user->id; // Retorna el id del insert ejecutado
        // Generar una billetera
        $userLocla=Wallet::create([
            'user_id' => $id_user,
            'balance' => 0,
            'chips'   => 0,
            'credit'  => 0,
            ]);
       // Genra datos empresa

       $userLocal=UsersBillingData::create([
            'user_id'         => $id_user,
            'bussines_name'   => $request->input('bussines_name'),
            'tax_treatment'   => $request->input('tax_treatment'),
            'address'         => $request->input('address_billing'),
            'city'            => $request->input('city'),
            'state'           => $request->input('state'),
            'document_type'   => $request->input('document_type'),
            'document_number' => $request->input('document_number'),
             ]);
             echo "UsersBillingData creada =>".$id_user. "\n" ;
       // Genera datos local
       /***********************
       *** Obtener el block ***
       ***********************/
       $pointLocation = new pointLocation(); // Instancamos la clase
       $pointSearched = $pointLocation->makePoint(json_decode($request->input('latlng')));

       $blocks = Block::all();
       //dd($blocks);
       foreach($blocks as $key => $block){
       // Armar el poligono
           $polygon = $pointLocation->makePolygon(json_decode($block->latlng));

           $total = 0;
           foreach($pointSearched as $key => $point){
               if($pointLocation->pointInPolygon($point, $polygon) > 0){$total = $total +1;}
           }
           //echo('$total = '.$total."</br>");
           if($total > 0){break;} // En cuanto encuentra una calle se corta ya que no puede estra en dos calles
         }
         echo('Block ='.$block->id. "<br>" );
         //dd($block->id);
       $userLocal=Local::create([
          'user_id'    => $id_user,
          'latlng'     => $request->input('latlng'),
          'fee'        => $request->input('fee'),       //(default es 0)
          'verified'   => 1,
          'block_id'   => $block->id,
          'address'    => $request->input('address'),
        ]);
      } // Fin del Auth::check
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
        //
        //dd($request->input('user_id'));
        $userUpdate = User::where('id', $request->input('user_id'))
                    ->update([
                      'name' => $request->input('bussines_name'),
                      'email' => $request->input('email'),
                      'phone' => $request->input('phone'),
                      'type' => $request->input('type'),
                      'password' => bcrypt($request->input('password')),
                    ]);
        $sersBillingDataUpdate = UsersBillingData::where('user_id', $request->input('user_id'))
                    ->update([
                      'bussines_name'   => $request->input('bussines_name'),
                      'tax_treatment'   => $request->input('tax_treatment'),
                      'address'         => $request->input('address_billing'),
                      'city'            => $request->input('city'),
                      'state'           => $request->input('state'),
                      'document_type'   => $request->input('document_type'),
                      'document_number' => $request->input('document_number'),
                    ]);
        $localUpdate = Local::where('id', $request->input('user_id'))
                    ->update([
                      'latlng'   => $request->input('latlng'),
                      'fee'        => $request->input('fee'),       //(default es 0)
                      'verified'   => 1,
                      'address'    => $request->input('address'),
                    ]);
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
      echo "Usuario  = ".Auth::user()->id. "<br>" ;
      echo "Block = ".$localData[0]->block_id. "<br>" ;

      echo "Patente = ".$request->input('plate'). "<br>" ;
      echo "type = ".$request->input('type'). "<br>" ;
      echo "horas = ".$request->input('time'). "<br>" ;
      echo "Token = ".$token. "<br>" ;
      $start = Carbon::now();
      $fin = Carbon::now();
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
            echo ("<h1>Fecha de Inicio = ".$start.'</h1></br>');
            echo ("<h1>Fecha de Fin = ".$endTime.'</h1></br>');
            echo ("<h1>Precio del ticket = ".$amount.'</h1></br>');
            echo('</br>');
            }
            else {
            $hours = 0;
            $detail = 'Ticket por Estadia el dia '.$start.' de la patente '.$request->input('plate');

            $prices = Block::where('id',$localData[0]->block_id)->first()->priceBlockBackEnd('day');
            $localPrices = json_decode($prices);
            $price = $localPrices[0];
            $amount = $price[0]->price;
            $endTime = $end;
            //$amount = $localPrices[0]->price;
            }
          //dd($prices);
          /*******************************************
          *** Generar el costo del estacionamiento ***
          *******************************************
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
          $endTime = $endTime->format('Y-m-d H:i:s');;
          echo ("<h1>Fecha de Inicio = ".$start.'</h1></br>');
          echo ("<h1>Fecha de Fin = ".$endTime.'</h1></br>');
          echo ("<h1>Precio del ticket = ".$amount.'</h1></br>');
          echo('</br>');

          */
          /************************
          *** Generar el ticket ***
          ************************/
          $ticket=Ticket::create([
            'user_id'    => Auth::user()->id,
            'plate' =>  $request->input('plate'),
            'time' => $hours,
            'start_time' => $start,
            'end_time' => $endTime,
            'block_id' => $localData[0]->block_id,
            'latlng'  => $localData[0]->latlng,
            'token'  => $token,
            'type' => $request->input('type'), //(time/day)
          ]);
       /***************************
       *** Grabar la operacion  ***
       ***************************/
       $operation = operation::create([
          'type'    => 'ticket', //(wallet/ticket/infringement)
          'type_id' => $ticket->id,
          'amount'  => $amount,
        ]);
        $id_operation = $operation->id;
        # Actualizar la tabla space_reservations con el ID de la operacion.
        Ticket::where('id', $ticket->id)
           ->update(['operation_id' => $operation->id]);

        /***************************
        *** Genera company_sales ***
        ***************************/
        $companySalesCreate = CompanySale::create([
            'user_id'      => Auth::user()->id,
            'operation_id' => $operation->id,
            'detail'       => $detail,       // 'Ticket '. $start.' - '.$endTime,
           ]);
        /*******************************
        *** Grabar la factura (bill) ***
        *******************************/
        $billsExist = Bill::all()->last();
        if(!$billsExist) {
           $next_bill = 1;
        }else {
           $next_bill = $billsExist->id + 1;
        }
        if ($amount > 0) {
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
               'operation_id' => $operation->id,
               'bill_id'      => $billCreate->id,
              ]);
        }

        /*********************************
        *** Actualizar Saldo del local ***
        *********************************/
        $walletExist = Wallet::where('user_id',Auth::user()->id)->first();
        $newBalance = $walletExist->balance - $amount;

        $updateWallet = Wallet::where('user_id',Auth::user()->id)
                                ->update(['balance'=>$newBalance]);


    }// fin funcion


}  // Fin de la clase
