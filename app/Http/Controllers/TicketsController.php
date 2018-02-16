<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Cost;
use Illuminate\Http\Request;

class TicketsController
{
    function tiketCost($data){
      echo "Hola funcion";
      //dd($data);
      $date = date('Y-m-d');
      $costs = Cost::where('start_date', '<=', $date)
                   ->where('end_date', '>=', $date)
                   ->orderBy('priority','desc')
                   ->get();

      dd($costs);
      //return('Hola funcion');
    }
}
