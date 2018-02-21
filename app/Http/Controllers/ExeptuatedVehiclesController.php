<?php

namespace App\Http\Controllers;

use App\Bill;
use App\CompanySale;
use App\ExeptuatedVehicle;
use App\ExeptuatedCauses;
use App\Operation;
use App\OperationsBill;
use App\User;
use App\Vehicle;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExeptuatedVehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
          $causes = ExeptuatedCauses::all();
          return view('exeptuatedvehicles.index',['causes'=>$causes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //json(['name' => 'Abigail', 'state' => 'CA'])
        $causes = ExeptuatedCauses::all();
        return view('exeptuatedvehicles.create',['causes'=>$causes]);
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
            /***************************************************
            ***  Grabar la Excepcion de vehiculos en blockes ***
            ***************************************************/
            $generalFunctions = new generalFunctions(); // Instancamos la clase
            // Registrar la patente si no existe
            $vehicleId = $generalFunctions->registerVehicle($request->input('createPlate'));
            $exeptuatedCauseId=ExeptuatedCauses::where('name', $request->input('createType'))->first()->id;
            //{"createType":"Frentistas","createPlate":"IQW938","createStart":"2017-08-28T08:00","createEnd":"2020-10-28T20:00","createCost":"100","createZone":"[]","createDetail":"Algun detalle"}
            $exeptuatedVehicle = ExeptuatedVehicle::create([
                'vehicle_id'          => $vehicleId,
                'detail'              => $request->input('createDetail'),
                'start_time'          => $request->input('createStart'),
                'end_time'            => $request->input('createEnd'),
                'latlng'              => $request->input('createZone'),
                'exeptuated_cause_id' => $exeptuatedCauseId
            ]);
            if($exeptuatedVehicle->save()){
              $exeptuatedVehicleid = $exeptuatedVehicle->id;
            }else{
              return response()->json(["error"=>"Error creando el vehiculo exceptuado en la base de datos"],422);
            }
            // Grabar la operacion
            $saveOperationId = $generalFunctions->operationSave('exeptuatedVehicles',$exeptuatedVehicleid,$request->input('createCost'));
            // Actualizar el exeptuated_vehicles con el id de la operacion.
            $vehicle = ExeptuatedVehicle::where('id', $exeptuatedVehicleid)->update(['operation_id' => $saveOperationId]);
            if ($request->input('createCost') > 0) {// Si el precio es mayor a 0 genera la venta de la compania y la factura
              // generar venta de la compania (company_sales)
              $saveBill = $generalFunctions->companySalesSave(Auth::user()->id,$saveOperationId,$request->input('createDetail'));
              // generar la factura (bills) y la realcion con la operacion
              $saveBill = $generalFunctions->billSave($request->input('createCost'),$request->input('createDetail'),$saveOperationId);
            }
            $exeptuatedVehicle['plate']=$exeptuatedVehicle->vehicle()->first()->plate;
            return response()->json($exeptuatedVehicle);
          }else{
            // No tiene permiso para esta accion
            return response()->json(["error"=>"Sin permiso para crear un vehiculo exceptuado"],403);
          }
        }else{// Tiene que hacer el login primero
          return response()->json(["error"=>"Tiene que estar logueado"],401);
        }
      }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExeptuatedVehicle  $exeptuatedVehicle
     * @return \Illuminate\Http\Response
     */
    public function show(ExeptuatedVehicle $exeptuatedVehicle)
    {
        //
    }
    public function showAll(){
      $vehicles = ExeptuatedVehicle::all();
      $arrOfVehicles=array();
      foreach ($vehicles as $vehicle) {
        array_push($arrOfVehicles,[
          $vehicle->causes()->first()->name,
          $vehicle->vehicle()->first()->plate,
          date("Y-m-d",strtotime($vehicle->start_time))."T".date("H:i",strtotime($vehicle->start_time)),
          date("Y-m-d",strtotime($vehicle->end_time))."T".date("H:i",strtotime($vehicle->end_time)),
          $vehicle->operation()->first()->amount,
          $vehicle->id,
          $vehicle->latlng,
          $vehicle->detail
          ]);
      }
      return response()->json([
          'aaData' => $arrOfVehicles
      ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExeptuatedVehicle  $exeptuatedVehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(ExeptuatedVehicle $exeptuatedvehicle)
    {
        //
        $causes = ExeptuatedCauses::all();
        $vehicule = $exeptuatedvehicle->vehicle();
        //dump($vehicule);
        // dd($vehicule);
        return view('exeptuatedvehicles.edit',['exeptuatedvehicle'=>$exeptuatedvehicle,'causes'=>$causes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExeptuatedVehicle  $exeptuatedVehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExeptuatedVehicle $exeptuatedvehicle)
    {
      if(Auth::check()){
        if(Auth::user()->type=="admsuper" && Auth::user()->account_status!="B" ){
            /***************************************************
            ***  Grabar la Excepcion de vehiculos en blockes ***
            ***************************************************/
            $generalFunctions = new generalFunctions(); // Instancamos la clase
            // Registrar la patente si no existe
            $vehicleId = $generalFunctions->registerVehicle($request->input('editPlate'));
            $exeptuatedCauseId=ExeptuatedCauses::where('name', $request->input('editType'))->first()->id;
            $exeptuatedVehicleUpdt = ExeptuatedVehicle::where('id', $exeptuatedvehicle->id)
              ->update([
                      'vehicle_id'          => $vehicleId,
                      'detail'              => $request->input('editDetail'),
                      'start_time'          => $request->input('editStart'),
                      'end_time'            => $request->input('editEnd'),
                      'latlng'              => $request->input('editZone'),
                      'exeptuated_cause_id' => $exeptuatedCauseId
                    ]);
            if(!$exeptuatedVehicleUpdt){
              return response()->json(["error"=>"Error actualizando el vehiculo exceptuado en la base de datos"],422);
            }
            $exeptuatedVehicle=ExeptuatedVehicle::where('id', $exeptuatedvehicle->id)->first();
            $exeptuatedVehicle['price']=$exeptuatedVehicle->operation()->first()->amount;
            return response()->json($exeptuatedVehicle);
          }else{
            // No tiene permiso para esta accion
            return response()->json(["error"=>"Sin permiso para actualizar un vehiculo exceptuado"],403);
          }
        }else{// Tiene que hacer el login primero
          return response()->json(["error"=>"Tiene que estar logueado"],401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExeptuatedVehicle  $exeptuatedVehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExeptuatedVehicle $exeptuatedVehicle)
    {
        //
    }
}
