<?php

namespace App;
use App\VehicleUser;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    //
    protected $fillable = [
      'name',
      'description',
    ];
}
