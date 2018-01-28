<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaBlock extends Model
{
    //
    protected $fillable = [
      'block_id',
      'area_id',
    ];

    public function block(){
      return $this->belongsTo('App\Block');
    }

    public function area(){
      return $this->belongsTo('App\Area');
    }

}
