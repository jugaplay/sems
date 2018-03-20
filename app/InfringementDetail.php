<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfringementDetail extends Model
{
    //
    protected $fillable = [
      'user_id',
      'infringement_id',
      'detail',
    ];

    public function infringement(){
      return $this->belongsTo('App\Infringement');
    }
    public function user(){
      return $this->belongsTo('App\User');
    }

}
