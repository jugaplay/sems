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
    function pdf (){
      return "/images/ejemplo/FACTURAC-0003-00000082.pdf";
    }
}
