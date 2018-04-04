<?php

namespace App\Http\Controllers;

use App\Infringement;
use App\InfringementCause;
use App\InfringementDetail;
use App\Owner;
use App\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Clase para manejar fechas de laravel
// Para manejar los archivos
use App\Http\Controllers\Controller;
//use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;



class InfringementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::check()){
        if(Auth::user()->type=="judge" && Auth::user()->account_status!="B" ){
          $infringements=Infringement::where('situation',"!=","before")->orderBy('updated_at','desc')->paginate(3);
          return view('infringements.index',['infringements'=>$infringements]);
        }
        if(Auth::user()->type=="driver" && Auth::user()->account_status!="B" ){
          $infringements=Auth::user()->infringements()->sortByDesc('date');
          return view('infringements.index',['infringements'=>$infringements]);
        }
      }
        return view('infringements.index');
    }
    public function filter(Request $request)
    {
      $infringementStarts=$request->input('infringementStarts');
      $infringementEnds=$request->input('infringementEnds');
      $infringementText=$request->input('infringementText');
      $infringementFilter=$request->input('infringementFilter');// Dominio Dni
      $infringementType=$request->input('infringementType');// open
      if(Auth::check()){
        if(Auth::user()->type=="judge" && Auth::user()->account_status!="B" ){
          $infringements=Infringement::where('situation',"!=","before");
          if($infringementType!=""){
            $infringements=($infringementType=="open")?$infringements->where('situation',"!=","close"):$infringements->where('situation',$infringementType);
          }
          if($infringementStarts!="" && $infringementEnds!="" ){
            $infringements=$infringements->where('date',">=",$infringementStarts)->where('date',"<=",$infringementEnds);
          }
          if($infringementText!=""){// Eventualmente agregar lo del dni
            switch ($infringementFilter) {
              case 'Dominio':// Filtra por dominio
                  $infringements=$infringements->where('plate',"like","%".$infringementText."%");
                break;
              case 'Dni':
                  $plates = Owner::where('document_type',"DNI")->where('document_number',"like","%".$infringementText."%")->get()->transform(function ($objet){
                    return $objet->vehicle->plate;
                  });
                  $infringements=$infringements->whereIn('plate',$plates);
                break;
              default:// Combino Dominio y Dni
                $plates = Owner::where('document_type',"DNI")->where('document_number',"like","%".$infringementText."%")->get()->transform(function ($objet){
                  return $objet->vehicle->plate;
                });
                $infringements=$infringements->where(function ($query) use($plates,$infringementText){ // Alguna de las dos opciones
                                                $query->whereIn('plate',$plates)
                                                      ->orWhere('plate',"like","%".$infringementText."%");
                                            });
                break;
            }
          }
          $infringements=$infringements->orderBy('updated_at','desc')->paginate(3);// ->appends($request::except('page'))
          return view('infringements.index',['infringements'=>$infringements])->with('values', $request);;
        }
      }
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
    public function showAll(){
      if(Auth::check()){
        if(Auth::user()->type=="inspector" && Auth::user()->account_status!="B" ){
          $infragmentCauses = InfringementCause::where('name',"!=","Sin ticket")->get();
          return response()->json($infragmentCauses);
        }else{
          // No tiene permiso para esta accion
          return response()->json(["error"=>"Sin permiso para ver los datos"],403);
        }
      }else{// Tiene que hacer el login primero
        return response()->json(["error"=>"Tiene que estar logueado"],401);
      }
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
        if(Auth::user()->type=="inspector" && Auth::user()->account_status!="B" ){
          //return response()->json($request);
          $generalFunctions = new generalFunctions(); // Instancamos la clase
          $block = $generalFunctions->returnBlockFromLatLng(json_decode($request->input('latlng')));
          $infringementCause = InfringementCause::where('id',$request->input('infringementCausesId'))->first();
          registerVehicle(strtoupper($request->input('infringementPlate')));// Si no existe el vehiculo lo creo
          $now = Carbon::now('America/Argentina/Buenos_Aires');
          $today= $now->format('Y-m-d');
          $endVoluntary = $now->addMonths(3)->format('Y-m-d');
          $infringement=Infringement::create([
            'plate'                    => strtoupper($request->input('infringementPlate')),
            'user_id'                  => Auth::user()->id,
            'date'                     => $today,
            'situation'                => 'voluntary', // Empieza como un pago voluntario
            'infringement_cause_id'    => $request->input('infringementCausesId'),
            'cost'                     => $infringementCause->cost,
            'voluntary_cost'           => $infringementCause->voluntary_cost,
            'voluntary_end_date'       => $endVoluntary,
            'latlng'                   => $request->input('latlng'),
            'block_id'                 => $block->id,
            ]);
            // Add image to relation
            $infringementDetail = new InfringementDetail();
            $infringementDetail->user_id = Auth::user()->id;
            $infringementDetail->detail = $request->input('infringementDetail');
            $infringement->details()->save($infringementDetail);
            return response()->json($infringement);
        }else{
          // No tiene permiso para esta accion
          return response()->json(["error"=>"Sin permiso para realizar una multa "],403);
        }
      }else{// Tiene que hacer el login primero
        return response()->json(["error"=>"Tiene que estar logueado"],401);
      } // Auth::user()
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
        if(Auth::check()){
          if(Auth::user()->type=="judge" && Auth::user()->account_status!="B" ){
            return view('infringements.show',['infringement'=>$infringement]);
          }
          if(Auth::user()->type=="driver" && Auth::user()->account_status!="B" ){
            if(count(Auth::user()->infringements()->where('id',$infringement->id)->first())>0){
                return view('infringements.show',['infringement'=>$infringement]);
            }else{// No tiene permiso para ver esta multa
              return view('error.index');
            }
          }
          // Probar si esta dentro de las infrigments del usuario
        }
          return view('error.index');

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
                  $saveOperationId = $generalFunctions->operationSave('App\Infringement',$request->input('infringementId'),$request->input('payment'));
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
    public function uploadImage(Request $request){
      if(Auth::check()){
        if(Auth::user()->type=="inspector" && Auth::user()->account_status!="B" ){
          $infringementId=$request->input('infringementId');
          if ($infringementId>0 && strpos($request->input('infringementImg'), 'image/jpeg;base64')) {
              $data = explode( ',', $request->input('infringementImg') );
              $img = str_replace(' ', '+', $data[1]);
              $image = base64_decode($img);
              $exif = exif_read_data($data[0]."," . $img);
              if (!empty($exif['Orientation'])) {// Si tiene una orientacion la roto!
        				switch ($exif['Orientation']) {
            			case 3:
            				$image = imagerotate($image, 180, 0);
            				break;
            			case 6:
            				$image = imagerotate($image, -90, 0);
            				break;
            			case 8:
            				$image = imagerotate($image, 90, 0);
            				break;
        				}
              }
              $file = 'public/infractions/'.$infringementId.'/'. uniqid() . '.jpg';
              Storage::put($file, $image);
              Storage::setVisibility($file, 'public');
              $url = Storage::url($file);
              $infringement = Infringement::where('id',$infringementId)->first();
              // Add image to relation
              $img = new Image();
              $img->url = $file;
              $infringement->images()->save($img);
              return response()->json(['infringement_id'=>$infringementId,'path'=>$file,'$url'=>$url]);
          }else{
              return response()->json(['error'=>"Datos mal enviados"],400);
          }
        }else{
          // No tiene permiso para esta accion
          return response()->json(["error"=>"Sin permiso para subir una imagen de una multa "],403);
        }
      }else{// Tiene que hacer el login primero
        return response()->json(["error"=>"Tiene que estar logueado"],401);
      }

    }
    public function uploadComments(Request $request){
      if(Auth::check()){
        if(Auth::user()->type=="judge" && Auth::user()->account_status!="B" ){
              $infringementId=$request->input('infringementId');
              $infringementComment=$request->input('infringementComment');
              $infringement=Infringement::where('id',$infringementId)->first();
              $detail = new InfringementDetail();
              $detail->detail = $infringementComment;
              $detail->user_id = Auth::user()->id;
              $infringement->details()->save($detail);
              return response()->json(['detail'=>$infringementComment,'user_name'=>Auth::user()->name,'user_img'=>imgOfTypeOfUser(Auth::user()->type)]);
        }else{
          // No tiene permiso para esta accion
          return response()->json(["error"=>"Sin permiso para subir una imagen de una multa "],403);
        }
      }else{// Tiene que hacer el login primero
        return response()->json(["error"=>"Tiene que estar logueado"],401);
      }

    }
    public function close(Request $request){
      if(Auth::check()){
        if(Auth::user()->type=="judge" && Auth::user()->account_status!="B" ){
          $generalFunctions = new generalFunctions(); // Instancamos la clase
          $infringementId=$request->input('infringementId');
          $infringementComment=$request->input('closeDetail');
          $closePrice=$request->input('closePrice');
          $infringement=Infringement::where('id',$infringementId)->first();
          // Le agrego el detalle del cierre
          $detail = new InfringementDetail();
          $detail->detail = $infringementComment;
          $detail->user_id = Auth::user()->id;
          $infringement->details()->save($detail);
          // Hago lo necesario para cerrarlo
          // grabar operacion
          $saveOperationId = $generalFunctions->operationSave('App\Infringement',$infringementId,$closePrice);
          // Actualizar el ticket con el id de la operacion.
              $infringement->update([
                'situation'    => 'close', //(before/saved/voluntary/judge/close/preclose)
                'close_date'   => date('Y-m-d'),
                'close_cost'   => $closePrice,
                'operation_id' => $saveOperationId,
                ]);
          // generar venta de la compania (company_sales)
          if($closePrice>0){
            $companySale = $generalFunctions->companySalesSave(Auth::user()->id,$saveOperationId,'infringement');
            // generar la factura (bills) y la realcion con la operacion
            $Bill = $generalFunctions->billSave($closePrice,'infringement',$saveOperationId);
          }
          return response()->json($infringement);
        }else{
          // No tiene permiso para esta accion
          return response()->json(["error"=>"Sin permiso para cerrar una infracción"],403);
        }
      }else{// Tiene que hacer el login primero
        return response()->json(["error"=>"Tiene que estar logueado"],401);
      }
    }
}
