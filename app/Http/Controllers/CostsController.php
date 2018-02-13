<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Area;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('costs.index');
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
        //
        if(Auth::check()){
            $cost=Cost::create([
              'area_id'  => $request->input('area_id'),
              'time_zone_start'  => $request->input('time_zone_start'),
              'time_zone_end'  => $request->input('time_zone_end'),
              'start_date'  => $request->input('start_date'),
              'end_date'  => $request->input('end_date'),
              'priority'  => $request->input('priority'),
              'cost'  => $request->input('cost'),
              'type'  => $request->input('type'),
              'day_start'  => $request->input('day_start'), // 1=> Domingo 7 => Sabado
              'day_end'  => $request->input('day_end'), // 1=> Domingo 7 => Sabado
            ]);
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
        //
        if(Auth::check()){
          $costUpdate=Cost::where('id', $cost->id)
          ->update([
            'area_id'  => $request->input('area_id'),
            'time_zone_start'  => $request->input('time_zone_start'),
            'time_zone_end'  => $request->input('time_zone_end'),
            'start_date'  => $request->input('start_date'),
            'end_date'  => $request->input('end_date'),
            'priority'  => $request->input('priority'),
            'cost'  => $request->input('cost'),
            'type'  => $request->input('type'),
            'day_start'  => $request->input('day_start'), // 1=> Domingo 7 => Sabado
            'day_end'  => $request->input('day_end'), //  1=> Domingo 7 => Sabado
          ]);
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
