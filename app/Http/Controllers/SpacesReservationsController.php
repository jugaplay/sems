<?php

namespace App\Http\Controllers;

use App\SpaceReservation;
use App\Block;
use App\Operation;
use App\Bill;
use App\OperationsBill;
use App\CompanySale;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpacesReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('spacereservations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $blocks = Block::all();
        return view('spacereservations.create',['blocks'=>$blocks]);
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
        echo "Grabar"."<br>";
        echo "Calle ".$request->block;
    /****************************************
    *** Grabar la tabla space_reservations ***
    ****************************************/
    $spacesreservatio = SpaceReservation::create([
        'identifier'    => $request->identifier,
        'company'       => $request->company,
        'start_time'    => $request->start_time,
        'end_time'      => $request->end_time,
        'block_id'      => $request->block,
        'latlng'      => $request->latlng,
        'longitude'     => $request->longitude,
        //'operation_id'  => $request->identifier,
        'type'          => $request->type, // (container/load unload)
        'size'          => $request->size,//(nro)
    ]);
    // $spacesreservatio->id;
    /***************************
    *** Grabar la operacion  ***
    ***************************/
    $operation = operation::create([
       'type'    => 'SpaceReservation', //(wallet/ticket/infringement)
       'type_id' => $spacesreservatio->id,
       'amount'  => $request->input('amount'),
     ]);
     $id_operation = $operation->id;
     # Actualizar la tabla space_reservations con el ID de la operacion.
     SpaceReservation::where('id', $spacesreservatio->id)
        ->update(['operation_id' => $operation->id]);

        /***************************
        *** Genera company_sales ***
        ***************************/
        $companySalesCreate = CompanySale::create([
          'user_id'      => Auth::user()->id,
          'operation_id' => $operation->id,
          'detail'       => 'Reserva '.$request->type,
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
            'detail'          => 'Reserva '.$request->type,
          ]);
          $operationBil = OperationsBill::create([
            'operation_id' => $operation->id,
            'bill_id'      => $billCreate->id,
           ]);

        }


    } // Fin function store

    /**
     * Display the specified resource.
     *
     * @param  \App\SpaceReservation  $spaceReservatio
     * @return \Illuminate\Http\Response
     */
    public function show(SpaceReservation $spaceReservatio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpaceReservation  $spaceReservatio
     * @return \Illuminate\Http\Response
     */
    public function edit(SpaceReservation $spaceReservatio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpaceReservation  $spaceReservatio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpaceReservation $spaceReservatio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpaceReservation  $spaceReservatio
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpaceReservation $spaceReservatio)
    {
        //
    }
}
