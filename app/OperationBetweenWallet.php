<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationBetweenWallet extends Model
{
    //
    protected $base = "operations_between_wallets";
    protected $fillable = [
      'operation_id_1',
      'operation_id_2',
    ];

    public function operation(){
      return $this->belongsTo('App\Operation','operation_id_1') + $this->belongsTo('App\Operation','operation_id_2');
    }

}
