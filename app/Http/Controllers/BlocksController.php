<?php

namespace App\Http\Controllers;

use App\Block;
use App\Area;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BlocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('blocks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('blocks.create');
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
        $block=Block::create([
          'latlng' => $request->input('latlng'),
          'street' => $request->input('street'),
          'numeration_min' => $request->input('numeration_min'),
          'numeration_max' => $request->input('numeration_max'),
          'spaces' => $request->input('spaces'),
          //'user_id' => Auth::user()->id
      ]);
      $id_block = $block->id;
      }
      /*******************************************
      *** Controlar si pertenece a alguna area ***
      *******************************************/
      $pointLocation = new pointLocation(); // Instancamos la clase
      $pointSearched = $pointLocation->makePoint(json_decode($request->input('latlng')));

      $areas = Area::all();
      foreach($areas as $key => $area){
      // Armar el poligono
          $polygon = $pointLocation->makePolygon(json_decode($area->latlng));
          $total = 0;
          foreach($pointSearched as $key => $point){
              if($pointLocation->pointInPolygon($point, $polygon) > 0){$total = $total +1;}
          }
          if ($total == 4) {$area->blocks()->attach($block->id);}
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        //
        dd($block);
        //$users = User::all();
        //return view('projects.edit',['project'=>$project,'users'=>$users]);
        ///photos/{photo}/edit
        return view('blocks.edit',['block'=>$block]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Block $block)
    {
        //
        if(Auth::check()){

          $blockUpdate = Block::where('id', $block->id)
                      ->update([
                        'latlng' => $request->input('latlng'),
                        'street' => $request->input('street'),
                        'numeration_min' => $request->input('numeration_min'),
                        'numeration_max' => $request->input('numeration_max'),
                        'spaces' => $request->input('spaces'),
                      ]);

        $pointLocation = new pointLocation(); // Instancamos la clase
        $pointCordenadas = json_decode($request->input('latlng'));
        $pointSearched = array();
        //Armar el punto
        $pointSearched = $pointLocation->makePoint($pointCordenadas);

        $block = Block::where('id', $block->id)->first();

        /************************************************************************************
        *** Controlar si sigue dentro del areas a las cuales esta asociada (areas_blocks) ***
        ************************************************************************************/
        foreach ($block->areas as $area) { // es lo mismo que ==> $areas = $block->areas()->get();
            $arrCordenadas = json_decode($area->latlng);
            $polygon = array();
            // Armar el poligono
            $polygon = $pointLocation->makePolygon($arrCordenadas);
            // Fijarse si los puntos estan en el area
            $total = 0;
            foreach($pointSearched as $key => $point){
              if($pointLocation->pointInPolygon($point, $polygon) > 0){$total = $total +1;}
            }
            if ($total <> 4){$block->areas()->detach($area->id);} // Elimina la relacion entre el blocke y el areas

        } // Fin de control si sigue en areas
        /************************************
        *** Controlar las areas faltantes ***
        ************************************/
        $areasId = $block->areas()->pluck('area_id')->toArray();
        $areas = Area::whereNotIn('id', $areasId)->get();
        foreach($areas as $key => $area){
        // Armar el poligono
            $polygon = $pointLocation->makePolygon(json_decode($area->latlng));
            $total = 0;
            foreach($pointSearched as $key => $point){
                if($pointLocation->pointInPolygon($point, $polygon) > 0){$total = $total +1;}
            }
            if ($total == 4) {$area->blocks()->attach($block->id);}
        }


        }// fin Auth
    } // Fin funcion update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $block)
    {
        //
        $areasId = $block->areas()->pluck('area_id')->toArray();
        $block->areas()->detach($areasId); // Elimina todos los ID
    }

    public function delete($block_id=null)
    {
        //
        //$findProject = Project::find($project_id);
        $findBlock = Block::where('id', $block_id)->first();
        //dump($findProject);
        return view('blocks.delete',['findBlock'=>$findBlock]);//->with($findProject);

    }
}
