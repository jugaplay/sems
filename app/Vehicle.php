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
      return $this->belongsToMany('App\User');
    }


}
