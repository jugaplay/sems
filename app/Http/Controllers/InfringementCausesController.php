<?php

namespace App\Http\Controllers;

use App\InfringementCause;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InfringementCausesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
       //
       //$companies = Company::all();
       return view('infringementcauses.index');
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         //
         return view('infringementcauses.create');
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
          $area=InfringementCause::create([
            'name'           => $request->input('name'),
            'detail'        => $request->input('detail'),
            'cost'           =>  $request->input('cost'),
            'voluntary_cost' => $request->input('voluntary_cost'),
          ]);
        }
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InfringementCause  $infringementCause
     * @return \Illuminate\Http\Response
     */
    public function show(InfringementCause $infringementCause)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InfringementCause  $infringementCause
     * @return \Illuminate\Http\Response
     */
    public function edit($infringementcausesId =null)
    {
      $infringementcauses = InfringementCause::where('id', $infringementcausesId)->first();
      return view('infringementcauses.edit',['infringementcauses'=>$infringementcauses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InfringementCause  $infringementCause
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InfringementCause $infringementCause)
    {
      if(Auth::check()){
        if(Auth::user()->type=="admsuper" && Auth::user()->account_status!="B" ){
          $InfringementCauseUpdate = InfringementCause::where('id', $request->input('infringementcausesId'))
                  ->update([
                    'name'           => $request->input('name'),
                    'detail'         => $request->input('detail'),
                    'cost'           => $request->input('cost'),
                    'voluntary_cost' => $request->input('voluntary_cost'),
                  ]);
             }
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InfringementCause  $infringementCause
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfringementCause $infringementCause)
    {
        //
    }
}
