<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable = [
      'visible_type',  //(infringement)
      'visible_id',
      'url',
    ];

    public function viewImage(){
          return $this->morphTo();
        }

}
