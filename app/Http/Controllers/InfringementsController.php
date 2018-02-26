<?php

namespace App\Http\Controllers;

use App\Infringement;
use App\InfringementCause;
use App\InfringementDetail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Clase para manejar fechas de laravel


class InfringementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('infringements.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $infragmentCauses = InfringementCause::all();
         return view('infringements.create',['infragmentCauses'=>$infragmentCauses]);
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

          $generalFunctions = new generalFunctions(); // Instancamos la clase
          echo "LatLng = ".$request->input('latlng').'</br>';
          // Obtener el block donde se produjo la infraccion
          $block = $generalFunctions->returnBlockFromLatLng(json_decode($request->input('latlng')));
          if(!$block){echo "No existe el block";return;}
          // Obtener el costo de la infraccion
          $infringementCause = InfringementCause::where('id',$request->input('infragmentCausesId'))->first();

          $infringement=Infringement::create([
            'plate'                    => $request->input('plate'),
            'user_id'                  => Auth::user()->id,
            'date'                     => $request->input('date'),
            'situation'                => 'saved', //(before/saved/voluntary/judge/close)
            'infringement_cause_id'    => $request->input('infragmentCausesId'),
            'cost'                     => $infringementCause->cost,
            'voluntary_cost'           => $infringementCause->voluntary_cost,
            'voluntary_end_date'       => $request->input('voluntary_end_date'),
            'latlng'                   => $request->input('latlng'),
            'block_id'                 => $block->id,
            ]);
            echo "Infraccion grabada";
        } // Auth::user()
      } // Auth::check()
    } // Fin store

    /**
     * Display the specified resource.
     *
     * @param  \App\Infringement  $infringement
     * @return \Illuminate\Http\Response
     */
    public function show(Infringement $infringement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Infringement  $infringement
     * @return \Illuminate\Http\Response
     */
    public function edit($infringementId =null)
    {
      $infringement = Infringement::where('id', $infringementId)->first();
      $infragmentCauses = InfringementCause::all();
      return view('infringements.edit',['infringement'=>$infringement,'infragmentCauses'=>$infragmentCauses]);
    }

    public function cancel($infringementId =null)
    {
      $infringement = Infringement::where('id', $infringementId)->first();
      return view('infringements.cancel',['infringement'=>$infringement]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Infringement  $infringement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Infringement $infringement)
    {
        $generalFunctions = new generalFunctions(); // Instancamos la clase
        echo "LatLng = ".$request->input('latlng').'</br>';
        // Obtener el block donde se produjo la infraccion
        $block = $generalFunctions->returnBlockFromLatLng(json_decode($request->input('latlng')));
        if(!$block){echo "No existe el block";return;}
        // Obtener el costo de la infraccion
        $infringementCause = InfringementCause::where('id',$request->input('infragmentCausesId'))->first();

        if(Auth::check()){
          if(Auth::user()->type=="admsuper" && Auth::user()->account_status!="B" ){
            $Infringement = Infringement::where('id', $infringement->id)
                    ->update([
                      'plate'                    => $request->input('plate'),
                      'user_id'                  => Auth::user()->id,
                      'date'                     => $request->input('date'),
                      'situation'                => 'before', //(before/saved/voluntary/judge/close)
                      'infringement_cause_id'    => $request->input('infragmentCausesId'),
                      'cost'                     => $infringementCause->cost,
                      'voluntary_cost'           => $infringementCause->voluntary_cost,
                      'voluntary_end_date'       => $request->input('voluntary_end_date'),
                      'latlng'                   => $request->input('latlng'),
                      'block_id'                 => $block->id,
                    ]);
               }
        }
    }

    public function cancelUpdate(Request $request)
    {
        $generalFunctions = new generalFunctions(); // Instancamos la clase
        echo('CancelUpdate = '.$request->input('infringementId'));
        echo('detail = '.$request->input('detail'));
        echo('payment = '.$request->input('payment'));
        echo('situation = '.$request->input('situation'));

        if ($request->input('payment') > 0) {$closeDate = date('Y-m-d');}else{$closeDate = Null;}

        if(Auth::check()){
          if(Auth::user()->type=="admsuper" && Auth::user()->account_status!="B" ){


            $infringementDetail=InfringementDetail::create([
                      'user_id'          => Auth::user()->id,
                      'infringement_id'  => $request->input('infringementId'),
                      'detail'           => $request->input('detail'),
                    ]);
              if ($request->input('payment') > 0) {
                  // grabar operacion
                  $saveOperationId = $generalFunctions->operationSave('infringement',$request->input('infringementId'),$request->input('payment'));
                  // Actualizar el ticket con el id de la operacion.
                  $Infringement = Infringement::where('id',$request->input('infringementId'))
                      ->update([
                        'situation'    => $request->input('situation'), //(before/saved/voluntary/judge/close/preclose)
                        'close_date'   => $closeDate,
                        'close_cost'   => $request->input('payment'),
                        'operation_id' => $saveOperationId,
                        ]);
                  // generar venta de la compania (company_sales)
                  $companySale = $generalFunctions->companySalesSave(Auth::user()->id,$saveOperationId,'infringement');
                  // generar la factura (bills) y la realcion con la operacion
                  $Bill = $generalFunctions->billSave($request->input('payment'),'infringement',$saveOperationId);

              } // Fin pago multa
           }
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Infringement  $infringement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Infringement $infringement)
    {
        //
    }

    /*******************************************************************
    *** Control de las infracciones previas (before) para  Controlar ***
    *** los 10 minutos de tolerancia en el estacionamiento           ***
    *******************************************************************/
    public function control(Infringement $infringement)
    {
      $generalFunctions = new generalFunctions(); // Instancamos la clase
      $infringements = Infringement::where('situation','before')->get();
      foreach ($infringements as $infringement) {
        $dateCreated = new carbon($infringement->created_at);// $endTime = new Carbon($minutePrice->starts);
        $ticket = $generalFunctions->controlTicket($infringement->plate);

        if($ticket){$fecha2 = new carbon($ticket->start_time);
                    $difference = $fecha2->diffInMinutes($dateCreated);
                    if($difference < 11){$situation = 'preclose';
                                         $detail ='Compro tiket dentro del plazo establecido';
                                         $close_date = date('Y-m-d');
                                         $close_cost = 0;
                                        }
                                        else
                                        {$situation = 'preclose';
                                         $detail ='No Compro tiket dentro del plazo establecido';
                                         $close_date = Null;
                                         $close_cost = Null;
                                        }
                    $infringementsUpdate = $generalFunctions->infringementsUpdate($infringement->id,$situation,$detail,$close_date,$close_cost);
                   }
                   else
                   {$fecha2 = new carbon();
                    $difference = $fecha2->diffInMinutes($dateCreated);
                    if($difference > 10){$situation = 'saved';
                                         $detail ='No Compro tiket dentro del plazo establecido';
                                         $close_date = Null;
                                         $close_cost = Null;
                                         $infringementsUpdate = $generalFunctions->infringementsUpdate($infringement->id,$situation,$detail,$close_date,$close_cost);
                                        }
                   }
        echo($infringement->plate.'  '.$infringement->block_id.'  '.$dateCreated.' fecha Control => '.$fecha2.' Difer=>'.$difference.'</br>');
      } // End foreach
    }// Fin de la rutina control

}
