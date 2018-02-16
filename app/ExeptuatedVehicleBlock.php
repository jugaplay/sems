<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExeptuatedVehicleBlock extends Model
{
    //
    //protected $table = 'exeptuated_vehicles_blocks';
    protected $fillable = [
      'exeptuated_vehicle_id',
      'latlng',
    ];

    public function exeptuated_vehicle(){
      return $this->belongsTo('App\ExeptuatedVehicle');
    }

}
