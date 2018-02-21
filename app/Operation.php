<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    //
    protected $fillable = [
      'type', //(wallet/ticket/infringement/spacereservation)
      'type_id',
      'amount',
    ];

    public function operational(){
          return $this->morphTo();
        }

}
