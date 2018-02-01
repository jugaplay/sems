<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $fillable = [
      'type',
      'letter',
      'branch_office',
      'number',
      'document_type',
      'document_number',
      'net',
      'iva',
      'total',
      'date',
      'detail',
    ];

}
