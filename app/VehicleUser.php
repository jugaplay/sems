<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleUser extends Model
{
    //
    protected $table = 'vehicles_users';
    protected $fillable = [
      'vehicle_id',
      'user_id',
    ];
}
