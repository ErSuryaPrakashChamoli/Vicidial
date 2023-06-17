<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController2 extends Controller
{
    //ReportController2

    public function showtime(){

        // dd("enter here");

        return view('show_time2');
    }

    public function getResults()
{

    // dd("enter here");
  

/*
    SELECT vla.user, vla.status, vl.start_epoch, UNIX_TIMESTAMP() - vl.start_epoch AS live_call_time
FROM vicidial_live_agents AS vla
JOIN vicidial_log AS vl ON vla.user = vl.user AND vla.lead_id = vl.lead_id
WHERE vla.status IN ('INCALL', 'CLOSER');

*/
    // dd("enter here");
    // Run your query and retrieve the results
//     $results = DB::connection('mysql_second')->select("
//     SELECT vla.user, vla.status, vl.start_epoch, UNIX_TIMESTAMP() - vl.start_epoch AS live_call_time
// FROM vicidial_live_agents AS vla
// JOIN vicidial_log AS vl ON vla.user = vl.user AND vla.lead_id = vl.lead_id
// WHERE vla.status IN ('INCALL', 'CLOSER') ") ;// Your query to fetch the results
  
//    $results = DB::connection('mysql_second')->table('vicidial_live_agents')
//      ->join('vicidial_log','vicidial_live_agents.user','=','vicidial_log.user')
//      ->select('vicidial_live_agents.user','vicidial_live_agents.status','vicidial_log.start_epoch')
//      ->whereIn('vicidial_live_agents.status',['INCALL','CLOSER'])
//      ->whereTime('last_call_time','=',now())
//      ->get();


    //  $data['results'] = DB::connection('mysql_second')->table('vicidial_live_agents')
    // ->where('user','=','RajeshKumar')
    // ->select('status','live_agent_id','callerid','last_call_time','last_update_time'
    // ,'last_call_finish','on_hook_agent','on_hook_ring_time','last_inbound_call_time','last_inbound_call_finish')
    //  ->get();


    $results = DB::connection('mysql_second')->table('vicidial_live_agents')
    ->where('user','=','RajeshKumar')
    ->select('status','live_agent_id','callerid','last_call_time','last_update_time'
    ,'last_call_finish','on_hook_agent','on_hook_ring_time','last_inbound_call_time','last_inbound_call_finish')
     ->get();

    //  dd($results);

    // $data['vicidialLogs'] = DB::connection('mysql_second')->table('vicidial_agent_log')
    // ->select('user',DB::raw('COUNT(*) AS total_calls'),
    // DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC((talk_sec)))) as total_talktime'),
    // DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time'),
    // DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('BOI')) as bath_pause_time"),
    // DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('BRK')) as BRK_pause_time"),
    // DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('MEET')) as Meet_pause_time"),
    // DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('TEA')) as tea_pause_time"),
    // DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC((wait_sec))+TIME_TO_SEC((talk_sec))+TIME_TO_SEC((dispo_sec)))) as total_time'),
    // DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC((dead_sec)))) as dead_sec'),
    // DB::raw("MIN(event_time) as agent_login"),
    // DB::raw("MAX(event_time) as agent_logout"),
    // )
    // // ->whereDate('event_time','=',now()->format('Y-m-d'))
    // ->whereDate('event_time','=','2023-06-07')
    // ->whereNotNull('event_time')
    // ->groupBy('user')
    // ->get();

    // $data['vicidialLogs'] = DB::connection('mysql_second')->table('vicidial_agent_log')
    // ->select('user',DB::raw('COUNT(*) AS total_calls'),
    // DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC((talk_sec)))) as total_talktime'),
    // DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time'),
    // DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('BOI')) as bath_pause_time"),
    // DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('BRK')) as BRK_pause_time"),
    // DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('MEET')) as Meet_pause_time"),
    // DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('TEA')) as tea_pause_time"),
    // DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC((wait_sec))+TIME_TO_SEC((talk_sec))+TIME_TO_SEC((dispo_sec)))) as total_time'),
    // DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC((dead_sec)))) as dead_sec'),
    // DB::raw("MIN(event_time) as agent_login"),
    // DB::raw("MAX(event_time) as agent_logout"),
    // )
    // // ->whereDate('event_time','=',now()->format('Y-m-d'))
    // ->whereDate('event_time','=','2023-06-07')
    // ->whereNotNull('event_time')
    // ->groupBy('user')
    // ->get();

   
    //   dd(response()->json($data));

    //   $data['result'] = "enter ho";

    // return response()->json($data);
    return response()->json($results);
}


}
