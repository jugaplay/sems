<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    //
    protected $fillable = [
      'latlng',
      'street',
      'numeration_max',
      'numeration_min',
      'spaces',
    ];

    public function areas(){
      return $this->belongsToMany('App\Area',$table='areas_blocks')->withTimestamps();
    }

}
