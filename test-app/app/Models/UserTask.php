<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTask extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable =['user_id','task_id','due_date','start_time','end_time','remarks','status_id'];
}
