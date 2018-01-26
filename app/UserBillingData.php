<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBillingData extends Model
{
    //
    protected $fillable = [
      'user_id',
      'bussines_name'
      'tax_treatment'
      'address'
      'city'
      'state'
      'document_type'
      'document_number'
    ]

    public function user(){
      return $this->belongsTo('App\User');
    }
}
