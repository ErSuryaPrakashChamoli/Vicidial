<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentDispostion extends Model
{
    use HasFactory;

    protected $table = 'vicidial_log';
    protected $connection = 'mysql_second';
}
