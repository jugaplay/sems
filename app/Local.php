<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    //
    protected $fillable = [
      'user_id',
      'latlng',
      'longitude',
      'fee',
      'verified',
      'block_id',
      'address',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

}
