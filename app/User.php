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
        'account_status', // B (baja) C (confirama) N(No confirmada)
    ];

    public function vehicles(){
      return $this->belongsToMany('App\Vehicle',$table='vehicle_users')->withTimestamps(); // Relacion many to many
    }

    public function wallet(){
      return $this->hasOne('App\Wallet');
    }

    public function local(){
      return $this->hasOne('App\Local');
    }

    public function userbillingdata(){
      return $this->hasOne('App\UsersBillingData');
    }
    public function notificationChannels(){
      return $this->hasMany('App\Notification');
    }
    public function bills(){
      $vehicles = $this->vehicles();
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



}
