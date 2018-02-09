<?php

namespace App\Http\Controllers;

use App\ExeptuatedVehicle;
use App\User;
use App\Vehicle;
use App\ExeptuatedCauses;
use App\Operation;
use App\Bill;
use App\OperationsBill;
use App\CompanySale;

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
          return view('exeptuatedvehicles.index');
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
        //
        //Verificar si el vehiculo existe en la base.
        $VehicleExist = Vehicle::where('plate', $request->input('plate'))->first();
        if (!$VehicleExist) {
          # grabar el vehiculo en la tabla
          $vehicle=Vehicle::create([
            'plate' => $request->input('plate'),
          ]);
          $id_vehiculo = $vehicle->id;
        }else {
          $id_vehiculo = $VehicleExist->id;
        }
       /******************************************
       *** Grabar la tabla exeptuated_vehicles ***
       ******************************************/
       $exeptuatedVehicle = ExeptuatedVehicle::create([
          'vehicle_id'          => $id_vehiculo,
          'detail'              => $request->input('detail'),
          'start_time'          => $request->input('start_time'),
          'end_time'            => $request->input('end_time'),
          'latlng'              => $request->input('latlng'),
          'exeptuated_cause_id' => $request->input('exeptuated_cause_id'),
        ]);
        $id_exception = $exeptuatedVehicle->id;
        //echo('Vehiculo exceptuado = '.$id_exception);
        /***************************
        *** Grabar la operacion  ***
        ***************************/
        $operation = operation::create([
           'type'    => 'ExeptuatedVehicle', //(wallet/ticket/infringement)
           'type_id' => $id_exception,
           'amount'  => $request->input('amount'),
         ]);
         $id_operation = $operation->id;
         # Actualizar la tabla exeptuated_vehicles con el ID de la operacion.
         ExeptuatedVehicle::where('id', $id_exception)
            ->update(['operation_id' => $operation->id]);
        /***************************
        *** Genera company_sales ***
        ***************************/
        $companySalesCreate = CompanySale::create([
          'user_id'      => Auth::user()->id,
          'operation_id' => $operation->id,
          'detail'       =>$request->input('detail'),
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
        //echo $next_bill;
        if ($request->input('amount') > 0) {
          $net = ($request->input('amount') /1.21);
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
            'total'           => $request->input('amount'),
            'date'            => date('Y-m-d'),
            'detail'          => $request->input('detail'),
          ]);
          $operationBil = OperationsBill::create([
            'operation_id' => $operation->id,
            'bill_id'      => $billCreate->id,
           ]);

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
        //echo "plate  =  ".$request->input('plate');
        //echo "  ID   = ".$exeptuatedvehicle->id;
          //Verificar si el vehiculo existe en la base.
        $VehicleExist = Vehicle::where('plate', $request->input('plate'))->first();
        if (!$VehicleExist) {
          # grabar el vehiculo en la tabla
          $vehicle=Vehicle::create([
            'plate' => $request->input('plate'),
          ]);
          $id_vehiculo = $vehicle->id;
        }else {
          $id_vehiculo = $VehicleExist->id;
        }
       // actualizar el id en exeptuated_vehicles
        ExeptuatedVehicle::where('id', $exeptuatedvehicle->id)
          ->update(['vehicle_id'        => $id_vehiculo,
                  'detail'              => $request->input('detail'),
                  'start_time'          => $request->input('start_time'),
                  'end_time'            => $request->input('end_time'),
                  'latlng'              => $request->input('latlng'),
                  'exeptuated_cause_id' => $request->input('exeptuated_cause_id'),
                ]);

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
