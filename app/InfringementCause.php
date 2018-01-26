<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfringementCause extends Model
{
    //
  protected $fillable=[
  	'name',
  	'detail',
  	'cost',
    'voluntary_cost',
  ];    
}
