<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    //
    protected $fillable = [
      'user_id',
      'latitude',
      'longitude',
      'fee',
      'verified',
      'address',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

}
