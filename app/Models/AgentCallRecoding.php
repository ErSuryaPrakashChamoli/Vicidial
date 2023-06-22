<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentCallRecoding extends Model
{
    use HasFactory;

    protected $table = 'recording_log';
    protected $connection = 'mysql_second';
    
}
