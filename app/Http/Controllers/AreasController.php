<?php

namespace App\Http\Controllers;

use App\Area;
use App\Block;
use App\AreaBlock;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('areas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('areas.create');
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
        if(Auth::check()){
          if(Auth::user()->type=="admsuper" && Auth::user()->account_status!="B" ){
            $activa=('Activa' == $request->input('createActive')) ? 1 : 0;
            $area=Area::create([
              'name'    => $request->input('createName'),
              'details' => $request->input('createDetail'),
              'latlng' => $request->input('createZone'),
              'active'  => $activa,
            ]);
            if($area->save()){
              $id_area = $area->id;
            }else{
              return response()->json(["error"=>"Error creando el area en la base de datos"],422);
            }
            /***************************************************
            *** Buscar los bloques que esten dentro del area ***
            ***************************************************/

            $pointLocation = new pointLocation(); // Instancamos la clase

            $arrCordenadas = json_decode($request->input('createZone'));
            // Armar el polygono con los puntos pasados en el imput
            $polygon = array();
            foreach ($arrCordenadas as $key => $value) {
                $polygon[] = $value[0]." ".$value[1];
            }

            $polygon[] = $arrCordenadas[0][0]." ".$arrCordenadas[0][1]; // La ultima tiene que ser igual a la primera
            //dump($polygon);

            // Leer todas las cuadras (block)
            $blocks = Block::all();
            //dump($blocks);
            foreach ($blocks as $key => $block) {
                // Armar cada punto con los datos del block
                $pointCordenadas = json_decode($block->latlng);
                //dump($pointCordenadas);

                $pointSearched = array();
                foreach ($pointCordenadas as $key => $value) {
                    $pointSearched[] = $value[0]." ".$value[1];
                }
                //dump($pointSearched);
                $total = 0;
                foreach($pointSearched as $key => $point){
                  if($pointLocation->pointInPolygon($point, $polygon) > 0){$total = $total +1;}
                }

                if($total == 4){$area->blocks()->attach($block->id);}

            }
            //$area
            $area['active_price']=$area->costs->where('end_date', '>', date('Y-m-d'))->where('start_date', '<=', date('Y-m-d'))->count();
            $area['active']=(1 == $area['active']);
            return response()->json($area);
          }else{
            // No tiene permiso para esta accion
            return response()->json(["error"=>"Sin permiso para crear una zona"],403);
          }
        }else{// Tiene que hacer el login primero
          return response()->json(["error"=>"Tiene que estar logueado"],401);
        }
    } // Fin funcion store

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }
    public function showAll(){
      $areas = Area::all();
      $arrOfAreas=array();
      foreach ($areas as $area) {// ->where('start_date', '<', date('Y-m-d'))
        $preciosActivos=$area->costs->where('end_date', '>', date('Y-m-d'))->where('start_date', '<=', date('Y-m-d'))->count();
        $activa=(1 == $area['active']) ? "Activa":"No activa";
        array_push($arrOfAreas,[$area['id'],$area['name'],$activa,$area['details'],$preciosActivos,$area['latlng']]);
      }
      return response()->json([
          'aaData' => $arrOfAreas
      ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        //dd($area);
        return view('areas.edit',['area'=>$area]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        //
        if(Auth::check()){
          if(Auth::user()->type=="admsuper" && Auth::user()->account_status!="B" ){
            $activa=('Activa' == $request->input('editActive')) ? 1 : 0;
          $areaUpdate=Area::where('id', $area->id)
          ->update([
            'name'    => $request->input('editName'),
            'details' => $request->input('editDetail'),
            'latlng' => $request->input('editZone'),
            'active'  => $activa,
          ]);
          //dump($areaUpdate);
          if($areaUpdate){
            $id_area = $area->id;
          }else{
            return response()->json(["error"=>"Error actualizando el area en la base de datos"],422);
          }
          $area=Area::where('id', $id_area)->first();
        /***************************************************
        *** Buscar los bloques que esten dentro del area ***
        ***************************************************/
        $pointLocation = new pointLocation(); // Instancamos la clase

        $arrCordenadas = json_decode($request->input('editZone'));
        // Armar el polygono con los puntos pasados en el imput ***
        $polygon = array();
        foreach ($arrCordenadas as $key => $value) {
            $polygon[] = $value[0]." ".$value[1];
        }

        $polygon[] = $arrCordenadas[0][0]." ".$arrCordenadas[0][1]; // La ultima tiene que ser igual a la primera

        // Leer todas las cuadras (block)
        $blocks = Block::all();
        //dump($blocks);

        $news = array();
        foreach ($blocks as $key => $block) {
            // Armar cada punto con los datos del block
            $pointCordenadas = json_decode($block->latlng);
            //dump($pointCordenadas);

            $pointSearched = array();
            foreach ($pointCordenadas as $key => $value) {
                $pointSearched[] = $value[0]." ".$value[1];
            }
            //dump($pointSearched);
            $total = 0;
            foreach($pointSearched as $key => $point){
              if($pointLocation->pointInPolygon($point, $polygon) > 0){$total = $total +1;}
            }

            if($total == 4){$news[] = $block->id;}
        } // fin del foreach
        $area->blocks()->sync($news);
        $area['active_price']=$area->costs->where('end_date', '>', date('Y-m-d'))->where('start_date', '<=', date('Y-m-d'))->count();
        $area['active']=(1 == $area['active']);
        return response()->json($area);

      }else{
        // No tiene permiso para esta accion
        return response()->json(["error"=>"Sin permiso para crear una zona"],403);
      }
    }else{// Tiene que hacer el login primero
      return response()->json(["error"=>"Tiene que estar logueado"],401);
    }

    } // fin update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }
}
