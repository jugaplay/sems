<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // Clase para manejar fechas de laravel


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

      public function  price($type){
        $startDate = Carbon::now();
        $end = Carbon::now();
        $endDate = $end->addHour(24);
        $time = $startDate->toTimeString();
        $day = $startDate->dayOfWeek;

      //----------------------------------//
        $colection=$this->hasMany('App\Cost');
        $arr=array();
        $lastPrice=null;
        $objetPrice=array();
        for($i=0;$i<1440;$i++){
          $startDate=$startDate->addMinutes(1);
          $DateString = $startDate->toDateString();
          $clone=clone $colection;
          $time = $startDate->toTimeString();
          $price=$clone->where('start_date', '<=', $DateString)
                            ->where('end_date', '>=', $DateString)
                            ->where('time_zone_start','<=',$time)
                            ->where('time_zone_end','>=',$time)
                            ->where('day_start','<=',$day)
                            ->where('day_end','>=',$day)
                            ->where('type','=',$type)
                            ->orderBy('priority','desc')
                            ->first();

        $price=($price==null) ? 0 : $price->cost;
          if($price!=$lastPrice){
            if($lastPrice==null){
              $objetPrice["price"]=$price;
              $objetPrice["starts"]=$startDate->toDayDateTimeString();
            }else{
              $objetPrice["ends"]=$startDate->toDayDateTimeString();
              $arr[]=$objetPrice;
              $objetPrice=array();
              $objetPrice["price"]=$price;
              $objetPrice["starts"]=$startDate->toDayDateTimeString(); // formta('Y-m-d H:i')
            }
            $lastPrice=$price;
          }
        }
        $objetPrice["ends"]=$startDate->toDayDateTimeString();
        $arr[]=$objetPrice;
        return $arr;

                                         //->get();
                                         //->first();
      }

      public function  priceBackEnd($type){

        if($type == 'time'){
          echo('Salgo por Hora');
          $startDate = Carbon::now();
          $end = Carbon::now();
          $endDate = $end->addHour(24);
          $time = $startDate->toTimeString();
          $day = $startDate->dayOfWeek;

          //----------------------------------//
          $colection=$this->hasMany('App\Cost');
          $arr=array();
          $lastPrice=null;
          $objetPrice=array();
          for($i=0;$i<1440;$i++){
            $startDate=$startDate->addMinutes(1);
            $DateString = $startDate->toDateString();
            $clone=clone $colection;
            $time = $startDate->toTimeString();
            $price=$clone->where('start_date', '<=', $DateString)
                              ->where('end_date', '>=', $DateString)
                              ->where('time_zone_start','<',$time)
                              ->where('time_zone_end','>=',$time)
                              ->where('day_start','<=',$day)
                              ->where('day_end','>=',$day)
                              ->where('type','=',$type)
                              ->orderBy('priority','desc')
                              ->first();
          if($price){$objetPrice["price"]=$price->cost/60;}else{$objetPrice["price"]=0;}
          $objetPrice["starts"]=$startDate->toDayDateTimeString();
          $arr[]=$objetPrice;
          }
          //return $arr;
        }else {
          echo('Salgo por estadia');
          $startDate = Carbon::now();
          $day = $startDate->dayOfWeek;
          $DateString = $startDate->toDateString();
          $colection=$this->hasMany('App\Cost');
          //dd($colection);
          $price=$colection->where('start_date', '<=', $DateString)
                            ->where('end_date', '>=', $DateString)
                            //->where('time_zone_start','<',$time)
                            //->where('time_zone_end','>=',$time)
                            ->where('day_start','<=',$day)
                            ->where('day_end','>=',$day)
                            ->where('type','=',$type)
                            ->orderBy('priority','desc')
                            ->first();
          //dd($price);
          if($price){$objetPrice["price"]=$price->cost;}else{$objetPrice["price"]=0;}
          $objetPrice["starts"]=$startDate->toDayDateTimeString();
          $arr[]=$objetPrice;
        }
        return $arr;
      }

}
