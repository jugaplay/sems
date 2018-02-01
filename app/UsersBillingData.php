<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersBillingData extends Model
{
    //
    protected $fillable = [
      'plate',
      'user_id',
      'bussines_name',
      'tax_treatment',
      'address',
      'city',
      'state',
      'document_type',
      'document_number',
    ];
}
