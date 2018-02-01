<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infringement extends Model
{
    //
    protected $fillable = [
      'plate',
      'user_id',
      'date',
      'situation', //(before/saved/voluntary/judge/close)
      'infringement_cause_id',
      'cost',
      'voluntary_cost',
      'voluntary_end_date',
      'close_date',
      'close_cost',
      'operation_id',
      'latitude',
      'longitude',
      'block_id',
    ];

    public function infringement_cause(){
      return $this->belongsTo('App\InfringementCause_id');
    }

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function operational(){
      return $this->morphMany('App\Operation','type');
    }

    public function viewImage(){
      return $this->morphMany('App\Imagen','visible_type');
    }

}
