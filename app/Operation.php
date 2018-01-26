<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    //
    protected $fillable = [
      'type', //(wallet/ticket/infringement)
      'type_id',
      'amount',
    ]

    public function operational(){
          return $this->morphTo();
        }

}
