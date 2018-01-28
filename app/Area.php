<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
    protected $fillable=[
      'name',
      'details',
      'active', //(true/false)
      ];

      public function blocks(){
        return $this->belongsToMany('App\Block');
      }

}
