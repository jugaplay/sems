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
      echo "Alta efectuada";
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
        //dump($block);
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
        foreach ($pointCordenadas as $key => $value) {
            $pointSearched[] = $value[0]." ".$value[1];
        }
        //dump($block->areas());
        $block = Block::where('id', $block->id)->first();
        //dd($block);

        // Verifcar si sigue dentro de las areas_blocks
        foreach ($block->areas as $area) { // es lo mismo que ==> $areas = $block->areas()->get();
            //dd($area);
            echo "Area =>".$area->id.'  '.$area->name.'   '.$area->latlng."</br>";
            $arrCordenadas = json_decode($area->latlng);
            $polygon = array();
            // Armar el poligono
            foreach ($arrCordenadas as $key => $value) {
                $polygon[] = $value[0]." ".$value[1];
            }
            $polygon[] = $arrCordenadas[0][0]." ".$arrCordenadas[0][1]; // La ultima tiene que ser igual a la primera
            $total = 0;
            // Fijarse si los puntos estan en el area
            foreach($pointSearched as $key => $point){
              if($pointLocation->pointInPolygon($point, $polygon) > 0){$total = $total +1;}
            }
            if ($total == 4) { echo "Pertenece y ya esta asociada </br>";
              # code...
            }else {
              echo "No pertenece y esta asociada. Se elimina </br>";
            //  $block->areas()->detach($area->id); // Elimina la relacion entre el blocke y el areas
            }
        } // Fin de control si sigue en areas
        $areasId = $block->areas()->pluck('area_id')->toArray();
        $areas = Area::whereNotIn('id', $areasId)->get();
        dd($areas);

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
    }
}
