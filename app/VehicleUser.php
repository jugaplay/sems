<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleUser extends Model
{
    //
    protected $fillable = [
      'vehicle_id',
      'user_id',
    ]

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function vehicle(){
      return $this->belongsTo('App\Vehicle');
    }

}
