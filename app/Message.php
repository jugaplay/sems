<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
      'name',
      'mail',
      'date',
      'state',
      'user_id',
      'type',
    ]

    public function user(){
      return $this->belongsTo('App\User');
    }

}
