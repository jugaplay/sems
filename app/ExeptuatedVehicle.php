<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExeptuatedVehicle extends Model
{
    //
    protected $fillable = [
      'vehicle_id',
      'detail',
      'latlng',
      'start_time',
      'end_time',
      'operation_id',
      'exeptuated_cause_id',
    ];

    public function vehicle(){
      return $this->belongsTo('App\Vehicle'); // Inversa del hasOne
    }

    public function operation(){
      return $this->belongsTo('App\Operation');
    }

    public function causes(){
      return $this->belongsTo('App\ExeptuatedCauses');
    }

}
