<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Task extends Model
{
    protected $fillable = [
        'task_name',
        'due_date',
        'is_deleted',
    ];

    //Todoリスト
    public static function getActiveTasks()
    {
        return self::where('is_deleted', false)->get();
    }

    //削除フラグ
    public static function markAsDeleted($id)
    {
        $task = self::find($id);
        $task->is_deleted = true;
        $task->save();
        return $task;
    }

    //ゴミ箱
    public static function getTrashTasks()
    {
        return self::where('is_deleted', true)->get();
    }

    //ゴミ箱から戻す
    public static function recoverTask($id)
    {
        $task = self::find($id);
        $task->is_deleted = false;
        $task->save();
        return $task;
    }

    //ゴミ箱から完全削除
    public static function deleteTrashTaskPermanently()
    {
        return self::where('is_deleted', true)->delete();
    }
}
