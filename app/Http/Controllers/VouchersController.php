<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Operation;
use App\Bill;
use App\Infringement;
use App\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Hash;

 function manualPaginate($items, $perPage = 12)
   {
       //Get current page form url e.g. &page=1
       $currentPage = LengthAwarePaginator::resolveCurrentPage();

       //Slice the collection to get the items to display in current page
       $currentPageItems = $items->slice(($currentPage - 1) * $perPage, $perPage);

       //Create our paginator and pass it to the view
       return new LengthAwarePaginator($currentPageItems, count($items), $perPage);
   }
class VouchersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('vouchers.index');
    }
    public function tickets(){
      if(Auth::check()){
        if(Auth::user()->type=="driver" && Auth::user()->account_status!="B" ){
          $tickets=Ticket::where('user_id',Auth::user()->id)->orderBy('start_time','desc')->paginate(3);
          return view('vouchers.tickets',['tickets'=>$tickets]);
        }
      }
      return view('error.index');
    }
    public function operations(){
      if(Auth::check()){
        if(Auth::user()->type=="driver" && Auth::user()->account_status!="B" ){
          $operations=Operation::where('operational_type','App\Wallet')->paginate(3); // ->('operational_id',Auth::user()->wallet->id)->orderBy('created_at','desc')
          return view('vouchers.operations',['operations'=>$operations]);
        }
      }
      return view('error.index');
    }
    public function bills(){
      if(Auth::check()){
        if(Auth::user()->type=="driver" && Auth::user()->account_status!="B" ){
          $bills=manualPaginate(Auth::user()->bills(),3)->setPath('bills'); // ->('operational_id',Auth::user()->wallet->id)->orderBy('created_at','desc')
          return view('vouchers.bills',['bills'=>$bills]);
        }
      }
      return view('error.index');
    }
    public function ticketSearch(Request $request){
       $data = (object) $request->json()->all();
       $ticket=Ticket::where('plate',strtoupper($data->plate))->where('token',$data->code)->first();
       if($ticket){
         $street=$ticket->block->street." (".$ticket->block->numeration_min."-".$ticket->block->numeration_max.")";
         return response()->json(["plate"=>$ticket->plate,"code"=>$ticket->token,"start"=>$ticket->start_time,"end"=>$ticket->end_time,"street"=>$street,"cost"=>$ticket->operation->amount,"bill"=>$ticket->operation->bill()->pdf()]);// 400 Bad Request
       }else{
         return response()->json(["error"=>"No se encontro el comprobante"],400);// 400 Bad Request
       }
    }
    public function infringementsSearch(Request $request){
      $data = (object) $request->json()->all();
      $infringementFilter=$data->filter;
      $infringementText=strtoupper($data->text);
      $infringements=Infringement::where('situation',"!=","before");
      switch ($infringementFilter) {
        case 'Dominio':// Filtra por dominio
            $infringements=$infringements->where('plate',$infringementText);
          break;
        case 'Dni':
            $plates = Owner::where('document_type',"DNI")->where('document_number',$infringementText)->get()->transform(function ($objet){
              return $objet->vehicle->plate;
            });
            $infringements=$infringements->whereIn('plate',$plates);
          break;
      }
      $infringements=$infringements->get()->map(function ($objet) {
            return [
              "id" => $objet->id,
              "plate" => $objet->plate,
              "tipo" => $objet->cause->name,
              "fecha" => $objet->date,
              "costo" => $objet->actualCost(),
              "detalle" => $objet->details->first()->detail,
              "estado" => $objet->situation,
              "hash" => bcrypt($objet->id),
              "img" => $objet->img()
            ];
        })->all();
      // Creo el hash bcrypt($request->input('password'));
      // Lo comparo Hash::check($puro, $cifrado)
      // img,plate,tipo, fecha, costo, detalle, estado, id, hash
      return response()->json($infringements);// Si esta vacio chequeo en el front que hacer

    }
    function infringementShow(Infringement $infringement, Request $request){
      if(Hash::check($infringement->id, $request->input('token'))){
          return view('infringements.show',['infringement'=>$infringement]);
      }else{// No tiene permiso para ver esta multa
        return view('error.index');
      }
    }

}
