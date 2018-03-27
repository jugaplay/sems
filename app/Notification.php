<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable = [
      'user_id',
      'notification_type_id',
      'address',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function type(){
      return $this->belongsTo('App\notificationType');
    }

}
