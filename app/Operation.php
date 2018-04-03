<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    //
    protected $fillable = [
      'operational_type', //(wallet/ticket/infringement/spacereservation)
      'operational_id',
      'amount',
    ];

    public function bill(){// No se permite usar has one con un pivot table
          return ($this->belongsToMany('App\Bill',$table='operation_bills')->count()>0)?$this->belongsToMany('App\Bill',$table='operation_bills')->first():NULL;
        }

}
