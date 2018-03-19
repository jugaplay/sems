<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    //
    protected $fillable = [
      'vehicle_id',
      'name',
      'document_type',
      'document_number',
      'address',
      'city',
      'state',
    ];
    public function vehicle(){
      return $this->belongsTo('App\Vehicle'); // Inversa del hasOne
    }
}
