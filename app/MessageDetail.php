<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageDetail extends Model
{
    //
    protected $fillable = [
      'message_id',
      'detail',
      'date',
      'state',
    ];

    public function message(){
      return $this->belongsTo('App\Message');
    }

}
