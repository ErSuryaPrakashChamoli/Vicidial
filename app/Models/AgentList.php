<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentList extends Model
{
    use HasFactory;


    protected $table = 'vicidial_users';
    protected $connection = 'mysql_second';
}
