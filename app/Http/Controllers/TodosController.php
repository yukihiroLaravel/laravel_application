<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    public function index(){
        $todos = Todo::orderBy('id','desc')->paginate(9);
        return view('todos.index',['todos' => $todos]);
    }

    public function store(Request $request){

        $request->validate(Todo::rules());

        $todo = new Todo;
        $todo->title = $request->title;
        $todo->is_completed = $request->is_completed ? 1 : 0;

        $todo->save();
        return back();
    }

    public function update(Request $request,Todo $todo){
        $todo->update(['is_completed' => !$todo->is_completed]);
        return redirect()->route('todos.index');
    }
    
    public function destroy(Todo $todo){
        $todo->delete();
        return redirect()->route('todos.index');
    }
}
