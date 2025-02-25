<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_name',
        'due_date',
        'is_deleted',
    ];

    public static function getActiveTasks()
    {
        return self::where('is_deleted', false)->get();
    }

    public static function markAsDeleted($id)
    {
        $task = self::find($id);
        $task->is_deleted = true;
        $task->save();
        return $task;
    }
}
