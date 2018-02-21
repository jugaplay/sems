<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Area;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* Funciones usadas */
function parseAreaCostType($type){
  return ($type == 'time') ? "Tiempo" : "Estadía";
}
function parseAreaCostTypeInverse($type){
  return ($type == 'Tiempo') ? "time" : "day";
}
function parseNumberDate($nro){
  switch ($nro) {
      case 1: return "Lunes"; break; case 2: return "Martes"; break; case 3: return "Miércoles"; break; case 4: return "Jueves"; break;
      case 5: return "Viernes"; break; case 6: return "Sábado"; break; default: return "Domingo"; break;
  }
}
function parseDateToNumber($nro){
  switch ($nro) {
    case "Lunes": return 1 ; break; case "Martes": return 2 ; break; case "Miércoles": return 3; break; case "Jueves": return 4; break;
    case "Viernes": return 5; break; case "Sábado": return 6; break; default: return 7; break;
  }
}
/* Fin Funciones */
class CostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $areas = Area::orderBy('name')->get();
        return view('costs.index',['areas'=>$areas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $areas = Area::all();
        return view('costs.create',['areas'=>$areas]);
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
          $cost=Cost::create([
            'area_id'  => $request->input('createAreaId'),
            'time_zone_start'  => $request->input('createStartTimezone'),
            'time_zone_end'  => $request->input('createEndTimezone'),
            'start_date'  => $request->input('createStarts'),
            'end_date'  => $request->input('createEnds'),
            'priority'  => $request->input('createPriority'),
            'cost'  => $request->input('createPrice'),
            'type'  => parseAreaCostTypeInverse($request->input('createType')),
            'day_start'  => parseDateToNumber($request->input('createStartDay')), // 1=> Domingo 7 => Sabado
            'day_end'  => parseDateToNumber($request->input('createEndDay')), // 1=> Domingo 7 => Sabado
          ]);
          if(!$cost->save()){
            return response()->json(["error"=>"Error creando el area en la base de datos"],422);
          }
          //$area
          $area=$cost->area()->first();
          $cost['area_id']=$area->id;
          $cost['area_name']=$area->name;
          return response()->json($cost);
        }else{
          // No tiene permiso para esta accion
          return response()->json(["error"=>"Sin permiso para crear una zona"],403);
        }
      }else{// Tiene que hacer el login primero
        return response()->json(["error"=>"Tiene que estar logueado"],401);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function show(Cost $cost)
    {
        //
    }

    public function showAll(){
      $costs = Cost::all();
      $arrOfCosts=array();
      foreach ($costs as $cost) {
        $area=$cost->area()->first();
        array_push($arrOfCosts,[
          $area->name.", id:".$area->id,
          parseAreaCostType($cost["type"]),
          parseNumberDate($cost["day_start"])."/".parseNumberDate($cost["day_end"]),
          substr($cost["time_zone_start"], 0, -3)."/".substr($cost["time_zone_end"], 0, -3),
          $cost["cost"],
          $cost["end_date"],
          $cost["id"],
          $area->id,
          $area->name,
          $cost["start_date"],
          parseNumberDate($cost["day_start"]),
          parseNumberDate($cost["day_end"]),
          substr($cost["time_zone_start"], 0, -3),
          substr($cost["time_zone_end"], 0, -3),
          $cost['priority']]);
      }
      return response()->json([
          'aaData' => $arrOfCosts
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function edit(Cost $cost)
    {
        $areas = Area::all();
        return view('costs.edit',['cost'=>$cost,'areas'=>$areas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cost $cost)
    {
        if(Auth::check()){
          if(Auth::user()->type=="admsuper" && Auth::user()->account_status!="B" ){
            $costUpdate=Cost::where('id', $cost->id)
            ->update([
              'area_id'  => $request->input('editAreaId'),
              'time_zone_start'  => $request->input('editStartTimezone'),
              'time_zone_end'  => $request->input('editEndTimezone'),
              'start_date'  => $request->input('editStarts'),
              'end_date'  => $request->input('editEnds'),
              'priority'  => $request->input('editPriority'),
              'cost'  => $request->input('editPrice'),
              'type'  => parseAreaCostTypeInverse($request->input('editType')),
              'day_start'  => parseDateToNumber($request->input('editStartDay')), // 1=> Domingo 7 => Sabado
              'day_end'  => parseDateToNumber($request->input('editEndDay')), // 1=> Domingo 7 => Sabado
            ]);
            /*if(!$cost->save()){
              return response()->json(["error"=>"Error creando el area en la base de datos"],422);
            }*/
            if($costUpdate){
              $id_cost = $cost->id;
            }else{
              return response()->json(["error"=>"Error actualizando el area en la base de datos"],422);
            }
            $cost=Cost::where('id', $id_cost)->first();
            $area=$cost->area()->first();
            $cost['area_id']=$area->id;
            $cost['area_name']=$area->name;
            return response()->json($cost);
          }else{
            // No tiene permiso para esta accion
            return response()->json(["error"=>"Sin permiso para crear una zona"],403);
          }
        }else{// Tiene que hacer el login primero
          return response()->json(["error"=>"Tiene que estar logueado"],401);
        }
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cost $cost)
    {
        //
    }
}
