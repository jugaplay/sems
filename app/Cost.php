<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    //
    protected $fillable = [
      'area_id',
      'time_zone_start',
      'time_zone_end',
      'start_date',
      'end_date',
      'priority',
      'cost',
      'type',
      'day_start',
      'day_end',
    ];

    public function area(){
      return $this->hasOne('App\Area');
    }

}
