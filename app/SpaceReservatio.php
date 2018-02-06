<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpaceReservatio extends Model
{
    //
    protected $fillable = [
      'identifier',
      'company',
      'start_time',
      'end_time',
      'block_id',
      'latlng',
      'operation_id',
      'type', // (container/load unload)
      'size' //(nro)
    ];

    public function block(){
      return $this->belongsTo('App\Block');
    }

    public function operation(){
      return $this->belongsTo('App\Operation');
    }

}
