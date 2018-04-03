<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationsBill extends Model
{
    //
    protected $table = "operation_bills";
    protected $fillable = [
      'operation_id',
      'bill_id',
    ];


}
