<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    //
    protected $fillable = [
      'latitude_1',
      'longitude_1',
      'latitude_2',
      'longitude_2',
      'latitude_3',
      'longitude_3',
      'latitude_4',
      'longitude_4',
      'street',
      'numeration_max',
      'numeration_min',
    ];

    public function areas(){
      return $this->belongsToMany('App\Area');
    }

}
