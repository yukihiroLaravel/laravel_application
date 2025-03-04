<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::getActiveTasks();
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    public function store(Request $request)
    {
        $task = new Task();
        $task->task_name = $request->task_name;
        $task->due_date = $request->due_date;
        $task->save();
        return redirect()->route('tasks.index');
    }

    //質問したい箇所
    //ビジネスロジックを書くことがコントローラーでは多いので
    //$task->task_name = $request->task_name;
    //$task->due_date = $request->due_date;
    //$task->save();
    //はモデルに書きたい
    //モデルに書いていくかもしくは、
    
    //public function store(Request $request)
    //{
    //      $request->validate([
    //        'task_name' => 'required|max:255',
    //        'due_date' => 'required|date',
    //      ]);
    //    Task::create($request->all());
    //    return redirect()->route('tasks.index');
    //}

    //もしくは下記の書き方
    //public function store(Request $request)
    //{
    //      $request->validate([
    //        'task_name' => 'required|max:255',
    //        'due_date' => 'required|date',
    //      ]);
    //      Task::create([
    //          'task_name' = $request->task_name,
    //          'due_date' = $request->due_date,
    //      ]);
    //     return redirect()->route('tasks.index');
    //}

    public function markAsDeleted($id)
    {
        Task::markAsDeleted($id);
        return redirect()->route('tasks.index');
    }

    public function trash()
    {
        $tasks = Task::getTrashTasks();
        return view('tasks.trash', [
            'tasks' => $tasks,
        ]);
    }

    public function recover($id)
    {
        Task::recoverTask($id);
        return redirect()->route('tasks.index');
    }

    public function deleteTrash()
    {
        Task::deleteTrashTaskPermanently();
        return redirect()->route('tasks.index');
    }
}
