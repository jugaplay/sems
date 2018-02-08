<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'type',
        'account_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function vehicles(){
      return $this->belongsToMany('App\Vehicle',$table='vehicle_users')->withTimestamps();
    }

    public function wallet(){
      return $this->belongsTo('App\Wallet');
    }

    public function local(){
      return $this->belongsTo('App\Local');
    }

    public function userBillingData(){
      return $this->belongsTo('App\UsersBillingData');
    }


}
