<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $fillable = [
      'plate',
];
    public function users(){
      return $this->belongsToMany('App\User',$table='vehicle_users');// Relacion many to many
    }

    public function exeptuatedvehicles(){
      return $this->hasOne('App\ExeptuatedVehicle');
    }

    public function owner(){
      return $this->hasOne('App\Owner');
    }

}
