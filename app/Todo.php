<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'todos';
    protected $fillable = ['title', 'explanation', 'difficulty','importance', 'complete', 'deadline', 'deadline_time',
        'completed_date', 'completed_time', 'user_id', 'folder_id'];
}
