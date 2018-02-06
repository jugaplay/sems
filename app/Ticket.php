<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable = [
      'user_id',
      'plate',
      'time',
      'start_time',
      'end_time',
      'block_id',
      'latlng',
      'check', //(null/user_id que lo chequeo)
      'operation_id',
      'token',
      'type', //(time/day)
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function block(){
      return $this->belongsTo('App\Block');
    }

    public function operation(){
      return $this->belongsTo('App\User');
    }

    public function operational(){
          return $this->morphMany('App\Operation','type');
    }
}
