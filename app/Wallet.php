<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    //
    protected $fillable = [
      'user_id',
      'balance',
      'chips',
      'credit',
  ];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function operations(){
          return $this->morphMany('App\Operation','operational');
        }
}
