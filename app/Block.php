<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // Clase para manejar fechas de laravel

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
    public function costs(){
      $colection=NULL;
      $arrCosts=$this->areas()->get()->transform(function($objet,$key){
        return $objet->costs();
      });
      foreach($arrCosts as $cost){
        $colection=($colection==NULL)?$cost:$colection->union($cost);
      }
      return $colection->get();// Trae toda la coleccion de costos
    }
    public function  timePriceNow(){
      $startDate = Carbon::now('America/Argentina/Buenos_Aires');
      $end = Carbon::now('America/Argentina/Buenos_Aires');
      $time = $startDate->toTimeString();
      $day = $startDate->dayOfWeek;
      $DateString = $startDate->toDateString();
      $colection=$this->costs();
      $price=$colection->where('start_date', '<=', $DateString)
                        ->where('end_date', '>=', $DateString)
                        ->where('time_zone_start','<=',$time)
                        ->where('time_zone_end','>=',$time)
                        ->filter(function ($objet) use ($day) {
                              if($objet->day_start<$objet->day_end){
                                return ($objet->day_start<=$day && $day<=$objet->day_end);
                              }else{
                                return ($objet->day_end>=$day || $day>=$objet->day_start);
                              }
                        })
                        ->where('type','=','time')
                        ->sortByDesc('priority')
                        ->first();
      $price=($price==null) ? 0 : $price->cost;
      return $price;
    }

    public function  priceBlock($type){
      if($type == 'time'){
        $startDate = Carbon::now('America/Argentina/Buenos_Aires');
        $end = Carbon::now('America/Argentina/Buenos_Aires');
        $endDate = $end->addHour(24);
        $time = $startDate->toTimeString();
        $day = $startDate->dayOfWeek;
      //----------------------------------//
        $arr=array();
        $lastPrice=null;
        $objetPrice= (object) array();
        $colection=$this->costs();
        // prubeas
        for($i=0;$i<1440;$i++){
          $startDate=$startDate->addMinutes(1);
          $DateString = $startDate->toDateString();
          $clone=clone $colection;
          $time = $startDate->toTimeString();
          $price=$clone->where('start_date', '<=', $DateString)
                            ->where('end_date', '>=', $DateString)
                            ->where('time_zone_start','<=',$time)
                            ->where('time_zone_end','>=',$time)
                            ->filter(function ($objet) use ($day) {
                                  if($objet->day_start<$objet->day_end){
                                    return ($objet->day_start<=$day && $day<=$objet->day_end);
                                  }else{
                                    return ($objet->day_end>=$day || $day>=$objet->day_start);
                                  }
                            })
                            ->where('type','=',$type)
                            ->sortByDesc('priority')
                            ->first();
          $price=($price==null) ? 0 : $price->cost;
          if($price!=$lastPrice){
            if($lastPrice==null){
              $objetPrice->price=$price;
              $objetPrice->starts=$startDate->toATOMString();
            }else{
              $objetPrice->ends=$startDate->toATOMString();
              $objtToPush = clone $objetPrice;
              array_push($arr, $objtToPush);
              $objetPrice=(object)  array();
              $objetPrice->price=$price;
              $objetPrice->starts=$startDate->toATOMString(); // formta('Y-m-d H:i')
            }
            $lastPrice=$price;
          }
        }
        $objetPrice->ends=$startDate->toATOMString();
        $objtToPush = clone $objetPrice;
        array_push($arr, $objtToPush);
        return json_encode($arr);
      }else {// Es del tipo dia
        $startDate = Carbon::now('America/Argentina/Buenos_Aires');
        $day = $startDate->dayOfWeek;
        $DateString = $startDate->toDateString();
        //$colection=$this->costs();
        $price=$this->costs()->where('start_date', '<=', $DateString)
                          ->where('end_date', '>=', $DateString)
                          ->filter(function ($objet) use ($day) {
                                if($objet->day_start<$objet->day_end){
                                  return ($objet->day_start<=$day && $day<=$objet->day_end);
                                }else{
                                  return ($objet->day_end>=$day || $day>=$objet->day_start);
                                }
                          })
                          ->where('type','=',$type)
                          ->sortByDesc('priority')
                          ->first();
        if($price){
          return floatval($price->cost);
        }else{
          return 0;
        }
      }
    }

    public function  priceBlockBackEnd($type){
      if($type == 'time'){
        $startDate = Carbon::now('America/Argentina/Buenos_Aires');
        $end = Carbon::now('America/Argentina/Buenos_Aires');
        $endDate = $end->addHour(24);
        $time = $startDate->toTimeString();
        $day = $startDate->dayOfWeek;
        //----------------------------------//
        //$colection=$this->hasMany('App\Cost');
        $arr=array();
        $objetPrice=array();
        $colection=$this->costs();
        for($i=0;$i<1440;$i++){
          $startDate=$startDate->addMinutes(1);
          $DateString = $startDate->toDateString();
          $clone=clone $colection;
          $time = $startDate->toTimeString();
          $price=$clone->where('start_date', '<=', $DateString)
                            ->where('end_date', '>=', $DateString)
                            ->where('time_zone_start','<=',$time)
                            ->where('time_zone_end','>=',$time)
                            ->filter(function ($objet) use ($day) {
                                  if($objet->day_start<$objet->day_end){
                                    return ($objet->day_start<=$day && $day<=$objet->day_end);
                                  }else{
                                    return ($objet->day_end>=$day || $day>=$objet->day_start);
                                  }
                            })
                            ->where('type','=',$type)
                            ->sortByDesc('priority')
                            ->first();
        if($price){$objetPrice["price"]=$price->cost/60;}else{$objetPrice["price"]=0;}
        $objetPrice["starts"]=$startDate->toDayDateTimeString();
        $arr[]=$objetPrice;
        }
        return $arr;
      }else {
        $startDate = Carbon::now('America/Argentina/Buenos_Aires');
        $day = $startDate->dayOfWeek;
        $DateString = $startDate->toDateString();
        $colection=$this->costs();
        $price=$colection->where('start_date', '<=', $DateString)
                          ->where('end_date', '>=', $DateString)
                          ->filter(function ($objet) use ($day) {
                                if($objet->day_start<$objet->day_end){
                                  return ($objet->day_start<=$day && $day<=$objet->day_end);
                                }else{
                                  return ($objet->day_end>=$day || $day>=$objet->day_start);
                                }
                          })
                          ->where('type','=',$type)
                          ->sortByDesc('priority')
                          ->first();
        if($price){
          return  floatval($price->cost);
        }else{
          return 0;
        }
      }
    }
}
