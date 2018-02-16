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


    public function  priceBlock($type){
      $FindePrice = $this->belongsToMany('App\Area',$table='areas_blocks')->get()->transform(function($objet,$key) use($type){
        return $objet->price($type);
      })->filter()->sortByDesc('priority');

      return $FindePrice;
    }

    public function  priceBlockBackEnd($type){
      $FindePrice = $this->belongsToMany('App\Area',$table='areas_blocks')->get()->transform(function($objet,$key) use($type){
        return $objet->priceBackEnd($type);
      })->filter()->sortByDesc('priority');

      return $FindePrice;
    }

}
