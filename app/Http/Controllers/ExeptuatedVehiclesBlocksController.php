<?php

namespace App\Http\Controllers;

use App\Block;
use App\ExeptuatedCauses;
use App\ExeptuatedVehicle;
use App\ExeptuatedVehicleBlock;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExeptuatedVehiclesBlocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('exeptuatedvehiclesblock.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $causes = ExeptuatedCauses::all();
        $blocks = Block::all();
        return view('exeptuatedvehiclesblock.create',['causes'=>$causes,'blocks'=>$blocks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /***************************************************
        ***  Grabar la Excepcion de vehiculos en blockes ***
        ***************************************************/
        $generalFunctions = new generalFunctions(); // Instancamos la clase
        // Registrar la patente si no existe
        $vehicleId = $generalFunctions->registerVehicle($request->input('plate'));
        // Registrar la patente de vehiculos exceptuados (exeptuated_vehicles)
        $exeptuatedVehicleid = $generalFunctions->exeptuatedVehiclesSave($vehicleId,$request->input('detail'),$request->input('start_time'),
                                                                $request->input('end_time'),$request->input('latlng'),
                                                                $request->input('exeptuated_cause_id'));
        // Grabar la operacion
        $saveOperationId = $generalFunctions->operationSave('App/ExeptuatedVehicleBlock',$exeptuatedVehicleid,$request->input('amount'));
        // Actualizar el exeptuated_vehicles con el id de la operacion.
        ExeptuatedVehicle::where('id', $exeptuatedVehicleid)->update(['operation_id' => $saveOperationId]);
        // generar venta de la compania (company_sales)
        $saveBill = $generalFunctions->companySalesSave(Auth::user()->id,$saveOperationId,$request->input('detail'));
        // generar la factura (bills) y la realcion con la operacion
        $saveBill = $generalFunctions->billSave($request->input('amount'),$request->input('detail'),$saveOperationId);
       /************************************************
       *** Grabar la tabla exeptuated_vehicles Block ***
       ************************************************/
       $exeptuatedVehicle = ExeptuatedVehicleBlock::create([
          'exeptuated_vehicle_id' => $exeptuatedVehicleid,
          'latlng'                => $request->input('latlng'),
         ]);
        $id_exception = $exeptuatedVehicle->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExeptuatedVehicleBlock  $exeptuatedVehicleBlock
     * @return \Illuminate\Http\Response
     */
    public function show(ExeptuatedVehicleBlock $exeptuatedVehicleBlock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExeptuatedVehicleBlock  $exeptuatedVehicleBlock
     * @return \Illuminate\Http\Response
     */
    public function edit(ExeptuatedVehicleBlock $exeptuatedVehicleBlock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExeptuatedVehicleBlock  $exeptuatedVehicleBlock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExeptuatedVehicleBlock $exeptuatedVehicleBlock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExeptuatedVehicleBlock  $exeptuatedVehicleBlock
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExeptuatedVehicleBlock $exeptuatedVehicleBlock)
    {
        //
    }
}
