<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Http\Controllers\pointLocation;

class Vehicle extends Model
{
    //
    protected $fillable = [
      'plate',
];
    public function users(){
      return $this->belongsToMany('App\User',$table='vehicle_users');// Relacion many to many
    }

    public function exeptuatedvehicles(){
      return $this->hasMany('App\ExeptuatedVehicle');// Por que puede tener varias exepciones
    }

    public function owner(){
      return $this->hasOne('App\Owner');
    }
    public function infringements(){
      return $this->hasMany('App\Infringement','plate', 'plate');
    }
    public function exeptuatedLatLng($latLng){
      if($this->exeptuatedvehicles()->exists()){
        $now = Carbon::now('America/Argentina/Buenos_Aires');
        $exeptuatedvehicles=$this->exeptuatedvehicles()->where('start_time','<=',$now)->where('end_time','>=',$now)->get();
        $pointLocation = new pointLocation();
          foreach ($exeptuatedvehicles as $exeptuated) {
            if($exeptuated->latlng==NULL){return $exeptuated->causes->name;} // es para todas las zonas
            if($pointLocation->pointInPolygonLatlng($latLng, json_decode($exeptuated->latlng))){return $exeptuated->causes->name;} // esta dentro de la zona
          }
        return false;
      }else{
        return false;
      }
    }

}
