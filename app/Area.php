<?php

namespace App;


use Illuminate\Database\Eloquent\Model;



class Area extends Model
{
    //
    protected $fillable=[
      'name',
      'details',
      'latlng',
      'active', //(1/0)
      ];

      public function blocks(){
        return $this->belongsToMany('App\Block',$table='areas_blocks')->withTimestamps();
      }
      public function costs(){
        return $this->hasMany('App\Cost');
      }

}
