<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentLogVici extends Model
{
    use HasFactory;
    protected $table = 'vicidial_agent_log';
    protected $connection = 'mysql_second';
}
