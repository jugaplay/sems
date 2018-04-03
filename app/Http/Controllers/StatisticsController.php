<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Clase para manejar fechas de laravel



class StatisticsController extends Controller
{

    public function index()
    {
        //
        return view('statistics.index');
    }

    public function ticketsStatistics($start,$end,$userId,$plate,$blockId,$type,$accumulate)
    //public function ticketsStatistics()
    {
        # $accumulate puede valer :
        # time => Acumula por fecha,hora y tipo
        # day => Acumula por fecha y tipo
        # type => Acumula por tipo
        /*
        echo 'Tickets Acumulados por tipo, dia, hora'."</br> ";
        $start = '2018-01-01 09:00:00';
        $end = '2018-12-31 23:59:59';
        $userId = 0;
        $plate = ''; //KKG679
        $blockId = 0; //3
        $type = ''; // time - day
        $accumulate = 'type';
        */

        $filter = array();
        $filter['start']=$start;
        $filter['end']=$end;
        $filter['start_end']=$start;
        $filter['end_end']=$end;
        // Construimos la consulta segun las variables pasadas
        $query = "select tickets.type,count(tickets.id) as cantidad,sum(operations.amount) as importe ";
        if($accumulate == 'time'){$query .= ",date(tickets.start_time),HOUR(tickets.start_time) ";}
        if($accumulate == 'day'){$query .= ",date(tickets.start_time) ";}
        $query .= " from tickets,operations";
        $query .= " where ((start_time BETWEEN :start and :end  or end_time BETWEEN :start_end and :end_end)) ";
        //$query .= " and end_time <= :end ";
        $query .= " and operations.operational_type = 'App/Ticket'";
        $query .= " and operations.operational_id = tickets.id";
        if($userId > 0 ){$query .= " and user_id = :userId";$filter['userId']=$userId; }
        if($blockId > 0 ){$query .= " and block_id = :blockId";$filter['blockId']=$blockId; }
        if(strlen($plate) > 0 ){$query .= " and plate = :plate";$filter['plate']=$plate; }
        if(strlen($type) > 0 ){$query .= " and type = :type";$filter['type']=$type; }
        if($accumulate == 'time'){$query .= " group by date(tickets.start_time),HOUR(tickets.start_time),tickets.type";
                                  $query .= " order by tickets.type,date(tickets.start_time),HOUR(tickets.start_time) ";}
        if($accumulate == 'day'){$query .= " group by date(tickets.start_time),tickets.type order by tickets.type,date(tickets.start_time)";}
        if($accumulate == 'type'){$query .= " group by tickets.type order by tickets.type";}
        echo($query."</br> ");
        $tickets = DB::select($query,$filter);
        //dd($tickets);
        return $tickets;
    } // fin ticketStatistics

    public function ticketsFiltros($start,$end,$userId,$plate,$blockId,$type)
    //public function ticketsFiltros()
    {
        /*
        echo 'Tickets con filtros';
        $start = '2018-02-16 09:00:00';
        $end = '2018-02-16 09:59:59';
        $userId = 0;
        $plate = ''; //KKG679
        $blockId = 0; //3
        $type = ''; // time - day
        */

        $filter = array();
        $filter['start']=$start;
        $filter['end']=$end;
        $filter['start_end']=$start;
        $filter['end_end']=$end;
        // Construimos la consulta segun las variables pasadas
        $query = "select * from tickets";
        $query .= " where  (start_time BETWEEN :start and :end  or end_time BETWEEN :start_end and :end_end)";
        if($userId > 0 ){$query .= " and user_id = :userId";$filter['userId']=$userId; }
        if($blockId > 0 ){$query .= " and block_id = :blockId";$filter['blockId']=$blockId; }
        if(strlen($plate) > 0 ){$query .= " and plate = :plate";$filter['plate']=$plate; }
        if(strlen($type) > 0 ){$query .= " and type = :type";$filter['type']=$type; }
        echo $query."</br> ";
        $tickets = DB::select($query,$filter);
        //dd($tickets);
        return $tickets;
    } // fin ticketsFiltros

    public function ticketsBlock($start,$end,$blockId)
    //public function ticketsBlock()
    {
        /*
        echo 'Tickets por blocke';
        $start = '2018-01-01 09:00:00';
        $end = '2018-12-31 09:59:59';
        $blockId = 0; //3
        */
        $filter = array();
        $filter['start']=$start;
        $filter['end']=$end;
        $filter['start_end']=$start;
        $filter['end_end']=$end;
        // Construimos la consulta segun las variables pasadas
        $query = "select block_id,count(id) from tickets ";
        $query .= " where (start_time BETWEEN :start and :end  or end_time BETWEEN :start_end and :end_end)";
        if($blockId > 0 ){$query .= " and block_id = :blockId";$filter['blockId']=$blockId; }
        $query .= " group by block_id";
        echo $query."</br> ";
        $tickets = DB::select($query,$filter);
        //dd($tickets);
        return $tickets;
    } // fin ticketsBlock

    public function infringementsBlock($start,$end,$blockId,$cause)
    //public function infringementsBlock()
    {
        /*
        echo ('Infracciones por blocke');
        $start = '2018-01-01 00:00:00';
        $end = '2018-12-31 23:59:59';
        $blockId = 0;
        $cause = 0;
        */
        $filter = array();
        $filter['start']=$start;
        $filter['end']=$end;


        // Construimos la consulta segun las variables pasadas
        $query = "select date,count(id)";
        if($blockId > 0 ){$query .= ",block_id";}
        if($cause > 0 ){$query .= ",infringement_cause_id";}
        $query .= " from infringements ";
        $query .= " where date >= :start ";
        $query .= "   and date <= :end ";
        if($blockId > 0 ){$query .= " and block_id = :blockId";$filter['blockId']=$blockId; }
        if($cause > 0 ){$query .= " and infringement_cause_id = :cause";$filter['cause']=$cause; }
        $query .= " group by date";
        if($blockId > 0 ){$query .= ",block_id";}
        if($cause > 0 ){$query .= ",infringement_cause_id";}
        echo $query."</br> ";
        $infringements = DB::select($query,$filter);
        //dd($infringements);
        return $infringements;
    } // fin ticketsBlock

    //public function operationsStatistics($start,$end,$type,$accumulate)
    public function operationsStatistics()
    {

        echo ('Infracciones por blocke');
        $start = '2018-01-01 00:00:00';
        $end = '2018-12-31 23:59:59';
        $type = '';
        $accumulate ='';

        $filter = array();
        $filter['start']=$start;
        $filter['end']=$end;


        // Construimos la consulta segun las variables pasadas
        $query = "select date(created_at),count(id)";
        if(strlen($type) > 0 ){$query .= ",type";}
        $query .= " from operations ";
        $query .= " where date(created_at) >= :start ";
        $query .= "   and date(created_at) <= :end ";
        if(strlen($type) > 0 ){$query .= " and type = :type";$filter['type']=$type; }
        $query .= " group by date(created_at)";
        if(strlen($type) > 0 ){$query .= ",type";}
        echo $query."</br> ";
        $operations = DB::select($query,$filter);
        dd($operations);
        return $operations;
    } // fin ticketsBlock


} // Fin de la clase StatisticsController
