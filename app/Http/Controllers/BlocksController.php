<?php

namespace App\Http\Controllers;

use App\Block;
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
      $arrCordenadas = json_decode($request->input('Coordenadas'));
      /*echo $request->input('name'). "\n";
      echo $arrCordenadas[0][0]. "\n" ;
      foreach ($arrCordenadas as $key => $value) {
        # code...
        echo($value[0].",".$value[1]);
      }
      */

      if(Auth::check()){
        $block=Block::create([
          'latitude_1' => $arrCordenadas[0][0],
          'longitude_1' => $arrCordenadas[0][1],
          'latitude_2' => $arrCordenadas[1][0],
          'longitude_2' => $arrCordenadas[1][1],
          'latitude_3' => $arrCordenadas[2][0],
          'longitude_3' => $arrCordenadas[2][1],
          'latitude_4' => $arrCordenadas[3][0],
          'longitude_4' => $arrCordenadas[3][1],
          'street' => $request->input('street'),
          'numeration_max' => $request->input('numeration_min'),
          'numeration_min' => $request->input('numeration_max'),
          //'user_id' => Auth::user()->id
      ]);
      $id_block = $block->id; 
      };

        //
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
    }

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
