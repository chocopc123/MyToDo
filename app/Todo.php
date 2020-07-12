<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';
    protected $fillable = ['title', 'explanation', 'difficulty', 'importance', 'complete', 'deadline', 'deadline_time', 'completed_date', 'completed_time'];
}
