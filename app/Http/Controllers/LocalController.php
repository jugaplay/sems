<?php

namespace App\Http\Controllers;

use App\User;
use App\Wallet;
use App\Local;
use App\UsersBillingData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocalController extends Controller
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
      return view('locals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('locals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // Alta de usuarios
      if (empty($request->input('password'))) {
          //$responseUserExist = json_decode($userExist);
          echo "La clave no puede estar vacia ";
          return;
      }

      if (empty($request->input('email'))) {
          //$responseUserExist = json_decode($userExist);
          echo "El mail es obligatorio ";
          return;
      }

      $userExist = User::where('email', $request->input('email'))->get();
      if (count($userExist) > 0) {
          //$responseUserExist = json_decode($userExist);
          echo "Mail ya existe => ".$userExist;
          return;
      }

      if(Auth::check()){
        $user=User::create([
          'name' => $request->input('bussines_name'),
          'email' => $request->input('email'),
          'phone' => $request->input('phone'),
          'type' => $request->input('type'),
          'account_status' => $request->input('account_status'),
          'password' => bcrypt($request->input('password')),
        ]);
        $id_user = $user->id; // Retorna el id del insert ejecutado
        // Generar una billetera
        $userLocla=Wallet::create([
            'user_id' => $id_user,
            'balance' => 0,
            'chips'   => 0,
            'credit'  => 0,
            ]);
       // Genra datos empresa
       $userLocal=UsersBillingData::create([
            'user_id'         => $id_user,
            'bussines_name'   => $request->input('bussines_name'),
            'tax_treatment'   => $request->input('tax_treatment'),
            'address'         => $request->input('address_billing'),
            'city'            => $request->input('city'),
            'state'           => $request->input('state'),
            'document_type'   => $request->input('document_type'),
            'document_number' => $request->input('document_number'),
             ]);
             echo "UsersBillingData creada =>".$id_user. "\n" ;
       // Genera datos local
       $userLocal=Local::create([
          'user_id'    => $id_user,
          'latlng'   => $request->input('latlng'),
          'fee'        => $request->input('fee'),       //(default es 0)
          'verified'   => 1,
          'address'    => $request->input('address'),
        ]);

        }
      }


    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($local_id=null)
    {
        $user = User::where('id', $local_id)->first();
        $local=Local::where('user_id', $local_id)->first();
        $usersBillingData=UsersBillingData::where('user_id', $local_id)->first();
        $wallet=Wallet::where('user_id', $local_id)->first();
        return view('locals.edit',['user'=>$user,'local'=>$local,'usersBillingData'=>$usersBillingData,'wallet'=>$wallet]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        //dd($request->input('user_id'));
        $userUpdate = User::where('id', $request->input('user_id'))
                    ->update([
                      'name' => $request->input('bussines_name'),
                      'email' => $request->input('email'),
                      'phone' => $request->input('phone'),
                      'type' => $request->input('type'),
                      'password' => bcrypt($request->input('password')),
                    ]);
        $sersBillingDataUpdate = UsersBillingData::where('user_id', $request->input('user_id'))
                    ->update([
                      'bussines_name'   => $request->input('bussines_name'),
                      'tax_treatment'   => $request->input('tax_treatment'),
                      'address'         => $request->input('address_billing'),
                      'city'            => $request->input('city'),
                      'state'           => $request->input('state'),
                      'document_type'   => $request->input('document_type'),
                      'document_number' => $request->input('document_number'),
                    ]);
        $localUpdate = Local::where('id', $request->input('user_id'))
                    ->update([
                      'latlng'   => $request->input('latlng'),
                      'fee'        => $request->input('fee'),       //(default es 0)
                      'verified'   => 1,
                      'address'    => $request->input('address'),
                    ]);
    } // Fin funcion update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $findLocal = Local::find( $user->id);
        if($findLocal->delete()){
                //redirect
                return redirect()->route('locals.index')
                ->with('success' , 'Local deleted successfully');
            }
    }

    public function delete($local_id=null)
    {
        //
        $user = User::where('id', $local_id)->first();
        $usersBillingData=UsersBillingData::where('user_id', $local_id)->first();
        $wallet=Wallet::where('user_id', $local_id)->first();
        return view('locals.delete',['user'=>$user,'usersBillingData'=>$usersBillingData,'wallet'=>$wallet]);//->with($findProject);

    }
}
