<?php

namespace App;
use Illuminate\Support\Facades\Storage;

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
    public function publicUrl(){
          return Storage::url($this->url);
        }

}
