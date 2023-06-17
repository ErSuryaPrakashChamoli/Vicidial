<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AgentWiseReport;
use App\Models\ViciDialAgent;
use App\Models\ViciDialAgentLog;
use App\Models\ViciTotalAgentLog;
use Illuminate\Support\Facades\DB;

use App\Models\AgentInfo;
use App\Models\AgentList;

use App\Models\AgentDispostion;


use Carbon\Carbon;
use Illuminate\Support\Collection;

class ReportController extends Controller
{

    public function AgentTotalCall(Request $request, $agent_name)
    {

        // $data['vicidialLogs'] = DB::connection('mysql_second')->table('vicidial_log')
        // ->select('User','call_date','length_in_sec','status ','phone_code ','phone_numbe')
        // ->where('user','=','agent_name')->get();

        $data['vicidialLogs'] = DB::connection('mysql_second')->table('vicidial_log')
            ->select(
                'user',
                'call_date',
                DB::raw('SEC_TO_TIME(TIME_TO_SEC((length_in_sec))) as total_talk_time'),
                'status as dispostion',
                'phone_code',
                'phone_number',
                'campaign_id'
            )
            ->where('user', '=', $agent_name)->get();

        $data['agent_name'] = $agent_name;


        // dd($data['vicidialLogs']);


        // $data['vicidialLogs'] = DB::connection('mysql_second')
        // ->table('vicidial_agent_log')
        // ->select('user','talk_sec','event_time','campaign_id'
        // )
        // ->whereDate('event_time','=',now()->format('Y-m-d'))
        // ->whereNotNull('event_time')
        // ->where('user',$agent_name)
        // ->orderBy('event_time','desc')->get();


        // dd($data['vicidialLogs']);

        return view('back_end/Report/agent_total_call', $data);
    }

    public function AgentList()
    {

        $today_date = Carbon::now()->toDateString();

        // ***********************************get today login agent**********************************
        $data['agentList'] = ViciDialAgentLog::distinct()->select('user')->whereDate('event_time', '=', $today_date)->get();

        AgentInfo::truncate();


        foreach ($data['agentList'] as $key => $value) {
            $agent_name = $value->user;

            //***********************************today total call */
            $agent_total_call = ViciDialAgentLog::where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->count();


            //   ***********************************************total talk time**********************************************
            $agent_total_talk_time = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(talk_sec))) as total_talktime ')->where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->get();
            $agent_total_talk_time_value = $agent_total_talk_time[0]->total_talktime;


            //   ***********************************************total dead time**********************************************
            $agent_total_deac_sec = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC((dead_sec)))) as dead_sec')->where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->get();
            $agent_total_deac_sec = $agent_total_deac_sec[0]->dead_sec;



            //   ***********************************************total wait time**********************************************

            $agent_total_wait_sec = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC((wait_sec)))) as wait_sec')->where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->get();
            $agent_total_wait_sec = $agent_total_wait_sec[0]->wait_sec;


            //   ***********************************************total dispo time**********************************************
            $agent_total_dispo_sec = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC((dispo_sec)))) as dispo_sec')->where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->get();
            $agent_total_dispo_sec = $agent_total_dispo_sec[0]->dispo_sec;



            //   ***********************************************total spand  time**********************************************
            $times = collect([
                $agent_total_talk_time_value,
                $agent_total_wait_sec,
                $agent_total_dispo_sec,
            ]);

            $totalTime = $times->reduce(function ($carry, $time) {
                $time = Carbon::parse($time);
                return $carry->addSeconds($time->second)->addMinutes($time->minute)->addHours($time->hour);
            }, Carbon::today()->setTime(0, 0, 0));

            $total_spand_time = $totalTime->format('H:i:s');

            //   ***********************************************total pause time**********************************************

            $agent_pause_time = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date);
                })->get();

            $agent_total_pause_time = $agent_pause_time[0]->total_pause_time;


            //   ***********************************************total bio pause time**********************************************

            $agent_pause_time_bio = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time_bio')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date)
                        ->where('sub_status', 'BOI');
                })->get();
            $agent_pause_time_bio = $agent_pause_time_bio[0]->total_pause_time_bio;


            //   ***********************************************total tea time**********************************************
            $agent_pause_time_tea = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time_tea')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date)
                        ->where('sub_status', 'TEA');
                })->get();
            $agent_pause_time_tea = $agent_pause_time_tea[0]->total_pause_time_tea;


            //   ***********************************************total pause lunch  time**********************************************
            $agent_pause_time_lunch = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time_lunch')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date)
                        ->where('sub_status', 'LUNCH');
                })->get();
            $agent_pause_time_lunch = $agent_pause_time_lunch[0]->total_pause_time_lunch;


            //   ***********************************************total pause meet time**********************************************
            $agent_pause_time_meet = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time_meet')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date)
                        ->where('sub_status', 'MEET');
                })->get();
            $agent_pause_time_meet = $agent_pause_time_meet[0]->total_pause_time_meet;


            //   ***********************************************total pause another**********************************************
            $agent_pause_time_another = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time_anthr')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date)
                        ->where('sub_status', 'ANTHR');
                })->get();
            $agent_pause_time_another = $agent_pause_time_another[0]->total_pause_time_anthr;



            //   ***********************************************total break another**********************************************
            $agent_pause_time_brk = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time_anthr')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date)
                        ->where('sub_status', 'BRK');
                })->get();
            $agent_pause_time_brk = $agent_pause_time_brk[0]->total_pause_time_anthr;

            //   ***********************************************total agent login time**********************************************

            $agent_agent_login = ViciDialAgentLog::selectRaw('MIN(event_time) as agent_login')->where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->get();
            $agent_agent_login = $agent_agent_login[0]->agent_login;


            //   ***********************************************total logout**********************************************

            $agent_agent_logout = ViciDialAgentLog::selectRaw('MAX(event_time) as agent_logout')->where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->get();
            $agent_agent_logout = $agent_agent_logout[0]->agent_logout;


            $agent_info = AgentInfo::create([
                'agent_name' => ($agent_name) ? $agent_name : 'no name',
                'total_call' => ($agent_total_call) ? $agent_total_call : '00:00:00',
                'total_talk' => $agent_total_talk_time_value,
                'totak_call_spand' => $total_spand_time,
                'total_pause' => $agent_total_pause_time,
                'pause_boi_time' => ($agent_pause_time_bio) ? $agent_pause_time_bio : '00:00:00',
                'pause_brk_time' => ($agent_pause_time_brk) ? $agent_pause_time_brk : '00:00:00',
                'pause_meet_time' => ($agent_pause_time_meet) ? $agent_pause_time_meet : '00:00:00',
                'pause_tea_time' => ($agent_pause_time_tea) ? $agent_pause_time_tea : '00:00:00',
                'pause_another' => ($agent_pause_time_another) ? $agent_pause_time_another : '00:00:00',
                'dead_sec' => ($agent_total_deac_sec) ? $agent_total_deac_sec : '00:00:00',
                'first_login' => $agent_agent_login,
                'last_login' => $agent_agent_logout,
            ]);
        }





        $data['vicidialLogs']  =  AgentInfo::all();

        // $data['vicidialLogs'] = DB::connection('mysql_second')->table('vicidial_agent_log')
        //     ->select(
        //         'user',
        //         DB::raw('COUNT(*) AS total_calls'),
        //         DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC((talk_sec)))) as total_talktime'),
        //         DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time'),
        //         DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('BOI')) as bath_pause_time"),
        //         DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('BRK')) as BRK_pause_time"),
        //         DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('MEET')) as Meet_pause_time"),
        //         DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('TEA')) as tea_pause_time"),
        //         DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC((wait_sec))+TIME_TO_SEC((talk_sec))+TIME_TO_SEC((dispo_sec)))) as total_time'),
        //         DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC((dead_sec)))) as dead_sec'),
        //         DB::raw("MIN(event_time) as agent_login"),
        //         DB::raw("MAX(event_time) as agent_logout"),
        //     )


        //     // ->whereDate('event_time','=',now()->format('Y-m-d'))
        //     ->whereDate('event_time', '=', '2023-06-07')
        //     ->whereNotNull('event_time')
        //     ->groupBy('user')
        //     ->get();



        // $agent_name = $data['vicidialLogs']->toArray();

        // dd($agent_name);



        // dd($data['vicidialLogs']);

        return view('back_end/Report/agent_list_new', $data);
        // return view('back_end/Report/agent_list',$data);

    }



    public function AgentTotalCall_develop(Request $request, $agent_name)
    {

        $data['vicidialLogs'] = DB::connection('mysql_second')->table('vicidial_agent_log')->select('user', 'talk_sec', 'event_time', 'campaign_id')->where('user', $agent_name)->orderBy('event_time', 'desc')->get();

        return view('back_end/Report/agent_total_call', $data);
    }

    public function AgentWiseReport()
    {

        // $data['vicidialLogs'] = AgentWiseReport::orderBy('call_date', 'desc')->get();

        $data['vicidialLogs'] = ViciDialAgent::all();
        return view('back_end/Report/agent_wise_report', $data);
    }

    public function AgentDailReport(Request $request, $agent_id)
    {

        $data['vicidialLogs'] = AgentWiseReport::where('user', $agent_id)->limit(1000)->orderBy('call_date', 'desc')->get();
        return view('back_end/Report/agent_daily_report', $data);
    }




    public function AgentList_development()
    {

        dd("surya");

        // dd("enter here");
        // $data['vicidialLogs'] = ViciDialAgentLog::all()->toArray(); 
        $data['vicidialLogs'] = ViciDialAgentLog::groupBy('user');

        // $get_data = DB::connection('mysql_second')->table('vicidial_agent_log')->select(DB::raw('count(*) as total'));
        // $get_data = DB::connection('mysql_second')->table('vicidial_agent_log')->groupBy('user');

        // $data['vicidialLogs'] = DB::connection('mysql_second')->table('vicidial_agent_log')->groupBy('user');


        // dd($data['vicidialLogs']);
        // $data['vicidialLogs'] = ViciDialAgentLog::groupBy('user')->selectRaw('count(*) as total, group_id')->get();

        // $data['vicidialLogs'] = ViciDialAgentLog::all()->groupBy('user');

        $first_query1 =  "SELECT user, COUNT(*) AS total_calls , sum(talk_sec) as total_talktime , event_time , campaign_id FROM vicidial_agent_log";

        $second_query2 = " WHERE date(event_time) = date(now())";

        $third_query3 = " GROUP BY user ";

        $full_query = $first_query1 . $second_query2 . $third_query3;

        // $data['vicidialLogs'] = DB::connection('mysql_second')->table('vicidial_agent_log')
        // ->select('user',DB::raw('COUNT(*) AS total_calls'),
        // DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC((talk_sec)))) as total_talktime'),
        // DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time'))->groupBy('user')->get();

        $data['vicidialLogs'] = DB::connection('mysql_second')->table('vicidial_agent_log')
            ->select(
                'user',
                DB::raw('COUNT(*) AS total_calls'),
                DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC((talk_sec)))) as total_talktime'),
                DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time'),
                DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('Bath')) as bath_pause_time"),
                DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('Break')) as BRK_pause_time"),
                DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('Meet')) as Meet_pause_time"),
                DB::raw("(select SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec)))  from vicidial_agent_log where sub_status in ('Meet')) as tea_pause_time"),

            )
            ->groupBy('user')
            ->get();


        // dd($full_query);

        //     DB::statement("SET SQL_MODE=''");
        // $data['vicidialLogs'] = DB::connection('mysql_second')->select("select COUNT(*) as total_calls ,user from  vicidial_agent_log". " GROUP BY user");

        // $data['vicidialLogs'] = DB::connection('mysql_second')->select(DB::raw($full_query ));
        // $data['vicidialLogs'] = DB::connection('mysql_second')->table('vicidial_agent_log')->get('user','campaign_id','event_time');

        // dd($data['vicidialLogs']);

        // $data['vicidialLogs'] = DB::connection('mysql_second')->select('select user,COUNT(*) as total_calls from  vicidial_agent_log'. ' GROUP BY user');


        /*
    SELECT user, COUNT(*) AS total_calls
    FROM vicidial_agent_log
    WHERE event_time >= '2023-01-01 00:00:00' AND event_time <= '2023-12-31 23:59:59'
    GROUP BY user;

    */

        // $vicidial_all = ViciDialAgentLog::all();

        // dd($data['vicidialLogs']);

        return view('back_end/Report/agent_list', $data);
    }



    public function AgentListCustom()
    {

        $today_date = Carbon::now()->toDateString();

        // ***********************************get today login agent**********************************
        $data['agentList'] = ViciDialAgentLog::distinct()->select('user')->whereDate('event_time', '=', $today_date)->get();

        // dd($data['agentList']);

        AgentInfo::truncate();


        foreach ($data['agentList'] as $key => $value) {
            $agent_name = $value->user;

            //***********************************today total call */
            $agent_total_call = ViciDialAgentLog::where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->count();


            //   ***********************************************total talk time**********************************************
            $agent_total_talk_time = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(talk_sec))) as total_talktime ')->where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->get();
            $agent_total_talk_time_value = $agent_total_talk_time[0]->total_talktime;


            //   ***********************************************total dead time**********************************************
            $agent_total_deac_sec = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC((dead_sec)))) as dead_sec')->where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->get();
            $agent_total_deac_sec = $agent_total_deac_sec[0]->dead_sec;



            //   ***********************************************total wait time**********************************************

            $agent_total_wait_sec = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC((wait_sec)))) as wait_sec')->where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->get();
            $agent_total_wait_sec = $agent_total_wait_sec[0]->wait_sec;


            //   ***********************************************total dispo time**********************************************
            $agent_total_dispo_sec = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC((dispo_sec)))) as dispo_sec')->where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->get();
            $agent_total_dispo_sec = $agent_total_dispo_sec[0]->dispo_sec;



            //   ***********************************************total spand  time**********************************************
            $times = collect([
                $agent_total_talk_time_value,
                $agent_total_wait_sec,
                $agent_total_dispo_sec,
            ]);

            $totalTime = $times->reduce(function ($carry, $time) {
                $time = Carbon::parse($time);
                return $carry->addSeconds($time->second)->addMinutes($time->minute)->addHours($time->hour);
            }, Carbon::today()->setTime(0, 0, 0));

            $total_spand_time = $totalTime->format('H:i:s');

            //   ***********************************************total pause time**********************************************

            $agent_pause_time = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date);
                })->get();

            $agent_total_pause_time = $agent_pause_time[0]->total_pause_time;


            //   ***********************************************total bio pause time**********************************************

            $agent_pause_time_bio = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time_bio')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date)
                        ->where('sub_status', 'BOI');
                })->get();
            $agent_pause_time_bio = $agent_pause_time_bio[0]->total_pause_time_bio;


            //   ***********************************************total tea time**********************************************
            $agent_pause_time_tea = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time_tea')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date)
                        ->where('sub_status', 'TEA');
                })->get();
            $agent_pause_time_tea = $agent_pause_time_tea[0]->total_pause_time_tea;


            //   ***********************************************total pause lunch  time**********************************************
            $agent_pause_time_lunch = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time_lunch')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date)
                        ->where('sub_status', 'LUNCH');
                })->get();
            $agent_pause_time_lunch = $agent_pause_time_lunch[0]->total_pause_time_lunch;


            //   ***********************************************total pause meet time**********************************************
            $agent_pause_time_meet = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time_meet')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date)
                        ->where('sub_status', 'MEET');
                })->get();
            $agent_pause_time_meet = $agent_pause_time_meet[0]->total_pause_time_meet;


            //   ***********************************************total pause another**********************************************
            $agent_pause_time_another = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time_anthr')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date)
                        ->where('sub_status', 'ANTHR');
                })->get();
            $agent_pause_time_another = $agent_pause_time_another[0]->total_pause_time_anthr;



            //   ***********************************************total break another**********************************************
            $agent_pause_time_brk = ViciDialAgentLog::selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(pause_sec))) as total_pause_time_anthr')
                ->where(function ($query) use ($agent_name, $today_date) {
                    $query->where('user', $agent_name)
                        ->whereDate('event_time', '=', $today_date)
                        ->where('sub_status', 'BRK');
                })->get();
            $agent_pause_time_brk = $agent_pause_time_brk[0]->total_pause_time_anthr;

            //   ***********************************************total agent login time**********************************************

            $agent_agent_login = ViciDialAgentLog::selectRaw('MIN(event_time) as agent_login')->where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->get();
            $agent_agent_login = $agent_agent_login[0]->agent_login;


            //   ***********************************************total logout**********************************************

            $agent_agent_logout = ViciDialAgentLog::selectRaw('MAX(event_time) as agent_logout')->where(function ($query) use ($agent_name, $today_date) {
                $query->where('user', $agent_name)
                    ->whereDate('event_time', '=', $today_date);
            })->get();
            $agent_agent_logout = $agent_agent_logout[0]->agent_logout;


            $agent_info = AgentInfo::create([
                'agent_name' => ($agent_name) ? $agent_name : 'no name',
                'total_call' => ($agent_total_call) ? $agent_total_call : '00:00:00',
                'total_talk' => $agent_total_talk_time_value,
                'totak_call_spand' => $total_spand_time,
                'total_pause' => $agent_total_pause_time,
                'pause_boi_time' => ($agent_pause_time_bio) ? $agent_pause_time_bio : '00:00:00',
                'pause_brk_time' => ($agent_pause_time_brk) ? $agent_pause_time_brk : '00:00:00',
                'pause_meet_time' => ($agent_pause_time_meet) ? $agent_pause_time_meet : '00:00:00',
                'pause_tea_time' => ($agent_pause_time_tea) ? $agent_pause_time_tea : '00:00:00',
                'pause_another' => ($agent_pause_time_another) ? $agent_pause_time_another : '00:00:00',
                'dead_sec' => ($agent_total_deac_sec) ? $agent_total_deac_sec : '00:00:00',
                'first_login' => $agent_agent_login,
                'last_login' => $agent_agent_logout,
            ]);
        }

        $data['vicidialLogs']  =  AgentInfo::all();


        return view('back_end/Report/agent_list_new', $data);
        // return view('back_end/Report/agent_list',$data);

    }


    public function AgentDisposition(Request $request, $agent_user)
    {

        $data['total_dispo_list']   = array();

        $data['total_dispo_list']['user'] = $agent_user;
        $data['total_dispo_list']['answeringMachine']      = '0';
        $data['total_dispo_list']['busy']                  = '0';
        $data['total_dispo_list']['call_back']             = '0';
        $data['total_dispo_list']['dead_air']              = '0';
        $data['total_dispo_list']['disconnected_number']   = '0';
        $data['total_dispo_list']['diclined_sale']         = '0';
        $data['total_dispo_list']['do_not_call']           = '0';
        $data['total_dispo_list']['no_answer']             = '0';
        $data['total_dispo_list']['not_intersted']         = '0';
        $data['total_dispo_list']['no_pitch_no_price']     = '0';
        $data['total_dispo_list']['sale_mode']             = '0';
        $data['total_dispo_list']['call_transfered']       = '0';
        $data['total_dispo_list']['ok_otp']                = '0';
        $data['total_dispo_list']['not_eligible']          = '0';
        $data['total_dispo_list']['voice_issue']           = '0';
        $data['total_dispo_list']['wrong_no']              = '0';
        $data['total_dispo_list']['self_employed']         = '0';
        $data['total_dispo_list']['language_barrier']      = '0';
        $data['total_dispo_list']['low_salary']            = '0';
        $data['total_dispo_list']['no_pich_no_price']      = '0';


        $today_date = Carbon::now()->toDateString();

        $data['agentList'] = ViciDialAgentLog::distinct()->select('user')->whereDate('event_time', '=', $today_date)->get();

        $data['vicidialLogs']  =  AgentDispostion::select('user', 'status AS disposition')->selectRaw('Count(*) as count')->where(function ($query) use ($agent_user, $today_date) {
            $query->where('user', $agent_user)
                ->whereDate('call_date', $today_date);
        })->groupBy('status')->get();


        foreach ($data['vicidialLogs'] as $key => $value) {

            switch ($value->disposition) {

                case 'A':

                    $data['total_dispo_list']['answeringMachine'] = $value->count;

                    break;

                case 'B':

                    $data['total_dispo_list']['busy'] = $value->count;

                    break;

                case 'CALLBK':

                    $data['total_dispo_list']['call_back'] = $value->count;


                    break;

                case 'DAIR':

                    $data['total_dispo_list']['dead_air'] = $value->count;

                    break;

                case 'DC':

                    $data['total_dispo_list']['disconnected_number'] = $value->count;

                    break;

                case 'DEC':

                    $data['total_dispo_list']['diclined_sale'] = $value->count;

                    break;

                case 'DNC':


                    $data['total_dispo_list']['do_not_call'] = $value->count;

                    break;

                case 'N':

                    $data['total_dispo_list']['no_answer'] = $value->count;

                    break;

                case 'NI':

                    $data['total_dispo_list']['not_intersted'] = $value->count;

                    break;


                case 'NP':

                    $data['total_dispo_list']['no_pitch_no_price'] = $value->count;

                    break;


                case 'SALE':

                    $data['total_dispo_list']['sale_mode'] = $value->count;

                    break;



                case 'XFER':

                    $data['total_dispo_list']['call_transfered'] = $value->count;

                    break;



                case 'otp':


                    $data['total_dispo_list']['ok_otp'] = $value->count;

                    break;



                case 'NE':

                    $data['total_dispo_list']['not_eligible'] = $value->count;

                    break;



                case 'VI':

                    $data['total_dispo_list']['voice_issue'] = $value->count;

                    break;



                case 'wn':


                    $data['total_dispo_list']['wrong_no'] = $value->count;
                    break;


                case 'se':

                    $data['total_dispo_list']['self_employed'] = $value->count;

                    break;




                case 'LB':

                    $data['total_dispo_list']['language_barrier'] = $value->count;
                    break;


                case 'LS':

                    $data['total_dispo_list']['low_salary'] = $value->count;

                    break;
            }
        }


        // dd($data['total_dispo_list']);

        // $answer_count =  $data['vicidialLogs'];

        // dd($answer_count);





        //  $data['vicidialLogs'] = (array)$data['vicidialLogs'];

        //  dd($data['vicidialLogs']);

        return view('back_end/Report/agent_disposition', $data);
    }
}
