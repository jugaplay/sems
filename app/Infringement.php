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
      'latlng',
      'block_id',
    ];

    public function cause(){
      return $this->belongsTo('App\InfringementCause','infringement_cause_id');
    }
    public function user(){
      return $this->belongsTo('App\User');
    }

    public function block(){
      return $this->belongsTo('App\Block');
    }

    public function operational(){
      return $this->morphMany('App\Operation','operational');
    }

    public function images(){
      return $this->morphMany('App\Image','visible');
    }
    public function details(){
      return $this->hasMany('App\InfringementDetail');
    }
    // spefici for views
    public function img(){
      $img = $this->images()->get()->first();
      return ($img!=NULL)?$img->publicUrl():"images/dummy/no-image.jpg";
    }
    public function vehicle(){
      return $this->belongsTo('App\Vehicle','plate', 'plate');// Lo busco a partir de la patente que es unica
    }
    public function actualDebtCost(){// Devuelve el costo actual de una multa
      if(in_array($this->situation, ["saved","voluntary","judge"])){
        return ($this->situation=="voluntary")?$this->voluntary_cost:$this->cost;
      }else{
        return 0;
      }
    }
    public function actualCost(){
      return ($this->close_cost!=NULL)?$this->close_cost:$this->actualDebtCost();
    }
}
