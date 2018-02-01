<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    //
    protected $fillable = [
      'user_id',
      'ip',
      'device_type',
      'platform',
      'os',
      'latitude',
      'longitude',
      'version',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

}
