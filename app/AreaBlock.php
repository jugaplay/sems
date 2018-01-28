<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaBlock extends Model
{
    //
    protected $table = "areas_blocks";
    protected $fillable = [
      'block_id',
      'area_id',
    ];


}
