<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySale extends Model
{
    //
    protected $fillable = [
      'user_id',
      'operation_id',
      'detail',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function operation(){
      return $this->belongsTo('App\Operation');
    }

}
