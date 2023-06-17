<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentInfo extends Model
{
    use HasFactory;


    protected $table = 'tbl_agent_info';

    protected $connection = 'mysql';


    protected $fillable =[

        'agent_name' ,
        'total_call' ,
        'total_talk',
        'totak_call_spand' ,
        'total_pause' ,
        'pause_boi_time' ,
        'pause_brk_time' ,
        'pause_meet_time' ,
        'pause_tea_time' ,
        'pause_another' ,
        'dead_sec',
        'first_login' ,
        'last_login' 
    ];


}
