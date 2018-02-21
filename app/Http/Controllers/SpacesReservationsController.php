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

function parseSpacesType($type){
  switch ($type) {
      case "container": return "Contenedor"; break;
      case "load_unload": return "Carga/Descarga"; break;
      default: return "Otro"; break;
  }
}
function parseInverseSpacesType($type){
  switch ($type) {
      case "Contenedor": return "container"; break;
      case "Carga/Descarga": return "load_unload" ; break;
      default: return "other"; break;
  }
}

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
      if(Auth::check()){
        if(Auth::user()->type=="admsuper" && Auth::user()->account_status!="B" ){
          $latLng=[floatval($request->input('createLatitud')),floatval($request->input('createLongitud'))];
          // Buscar el block id!!
          $generalFunctions = new generalFunctions();
          $block=$generalFunctions->returnBlockFromLatLng($latLng);
          if(is_null($block)){// No se encontro ningun block en el area
            return response()->json(["error"=>"El punto no pertenece a ninguna cuadra cargada"],400);// 400 Bad Request
          }
          // Fin buscar el block id
          $spacesreservation = SpaceReservation::create([
              'identifier'    => $request->input('createIdentifier'),
              'company'       => $request->input('createCompany'),
              'start_time'    => $request->input('createStart'),
              'end_time'      => $request->input('createEnd'),
              'block_id'      => $block->id,
              'latlng'        => json_encode($latLng),
              'type'          => parseInverseSpacesType($request->input('createType')), // (container/load unload)
              'size'          => $request->input('createSize'),//(nro)
          ]);
          if(!$spacesreservation->save()){
            return response()->json(["error"=>"Error creando la reserva en la base de datos"],422);
          }
          // $spacesreservatio->id;
          /***************************
          *** Grabar la operacion  ***
          ***************************/
          $operation = operation::create([
             'type'    => 'SpaceReservation', //(wallet/ticket/infringement)
             'type_id' => $spacesreservation->id,
             'amount'  => $request->input('createCost'),
           ]);
           $id_operation = $operation->id;
           # Actualizar la tabla space_reservations con el ID de la operacion.
           SpaceReservation::where('id', $spacesreservation->id)
              ->update(['operation_id' => $operation->id]);

              /***************************
              *** Genera company_sales ***
              ***************************/
              $companySalesCreate = CompanySale::create([
                'user_id'      => Auth::user()->id,
                'operation_id' => $operation->id,
                'detail'       => 'Reserva '.$request->input('createType'),
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
              if ($request->input('createCost') > 0) {
                $net = ($request->input('createCost') /1.21);
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
                  'total'           => $request->input('createCost'),
                  'date'            => date('Y-m-d'),
                  'detail'          => 'Reserva '.$request->input('createType'),
                ]);
                $operationBil = OperationsBill::create([
                  'operation_id' => $operation->id,
                  'bill_id'      => $billCreate->id,
                 ]);

              }
              $spacesreservation['street_name']=$block->street;
              return response()->json($spacesreservation);
        }else{
          // No tiene permiso para esta accion
          return response()->json(["error"=>"Sin permiso para crear una zona"],403);
        }
      }else{// Tiene que hacer el login primero
        return response()->json(["error"=>"Tiene que estar logueado"],401);
      }
    } // Fin function store

    /**
     * Display the specified resource.
     *
     * @param  \App\SpaceReservation  $spaceReservatio
     * @return \Illuminate\Http\Response
     */
    public function show(SpaceReservation $spaceReservation)
    {
        //
    }

    public function showAll(){
      $spaces = SpaceReservation::all();
      $arrOfSpaces=array();
      foreach ($spaces as $space) {
        $operation=$space->operation()->first();
        $block=$space->block()->first();
        $latLng=json_decode($space->latlng);
        array_push($arrOfSpaces,[
          $block->street,
          parseSpacesType($space->type),
          $space->identifier,
          $space->company,
          $space->size,
          date("Y-m-d",strtotime($space->start_time))."T".date("H:i",strtotime($space->start_time)),
          date("Y-m-d",strtotime($space->end_time))."T".date("H:i",strtotime($space->end_time)),
          $operation->amount,
          $space->id,
          $latLng[0],
          $latLng[1]]);
      }
      return response()->json([
          'aaData' => $arrOfSpaces
      ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpaceReservation  $spaceReservatio
     * @return \Illuminate\Http\Response
     */
    public function edit(SpaceReservation $spacereservation)
    {
        //
        //dd($spacereservation);
        $blocks = Block::all();
        return view('spacereservations.edit',['spacereservation'=>$spacereservation,'blocks'=>$blocks]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpaceReservation  $spaceReservatio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpaceReservation $spacereservation)
    {
      if(Auth::check()){
        if(Auth::user()->type=="admsuper" && Auth::user()->account_status!="B" ){
          $latLng=[floatval($request->input('editLatitud')),floatval($request->input('editLongitud'))];
          // Buscar el block id!!
          $generalFunctions = new generalFunctions();
          $block=$generalFunctions->returnBlockFromLatLng($latLng);
          if(is_null($block)){// No se encontro ningun block en el area
            return response()->json(["error"=>"El punto no pertenece a ninguna cuadra cargada"],400);// 400 Bad Request
          }
        $spacesReservationUpdt=SpaceReservation::where('id', $spacereservation->id)
           ->update([
             'identifier'    => $request->input('editIdentifier'),
             'company'       => $request->input('editCompany'),
             'start_time'    => $request->input('editStart'),
             'end_time'      => $request->input('editEnd'),
             'block_id'      => $block->id,
             'latlng'        => json_encode($latLng),
             'type'          => parseInverseSpacesType($request->input('editType')), // (container/load unload)
             'size'          => $request->input('editSize'),//(nro)
           ]);
           if($spacesReservationUpdt){
             $id_space = $spacereservation->id;
           }else{
             return response()->json(["error"=>"Error actualizando el espacio en la base de datos"],422);
           }
           $spacesreservation=SpaceReservation::where('id', $id_space)->first();
           $spacesreservation['street_name']=$block->street;
           $spacesreservation['cost']=$spacesreservation->operation()->first()->amount;
           return response()->json($spacesreservation);
     }else{
       // No tiene permiso para esta accion
       return response()->json(["error"=>"Sin permiso para editar una zona"],403);
     }
   }else{// Tiene que hacer el login primero
     return response()->json(["error"=>"Tiene que estar logueado"],401);
   }

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
