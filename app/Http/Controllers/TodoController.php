<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::where('complete', false)->orderBy('created_at', 'desc')->get();
        $index = "/index_completed";
        $index_title = "達成済みToDoリスト";
        return view('todo.index', ['todos' => $todos, 'index' => $index, 'index_title' => $index_title]);
    }

    public function index_completed(){
        $todos = Todo::where('complete', true)->orderBy('created_at', 'desc')->get();
        $index = "/";
        $index_title = "未達成ToDoリスト";
        return view('todo.index', ['todos' => $todos, 'index' => $index, 'index_title' => $index_title]);
    }

    public function create(){
        return view('todo.create');
    }

    public function store(Request $request){
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->explanation = $request->explanation;
        $todo->difficulty = $request->difficulty;
        $todo->importance = $request->importance;
        $todo->complete = false;
        $todo->deadline = $request->deadline;
        if($request->deadline_time){
            $todo->deadline_time = $request->deadline_time;
        }
        $todo->save();

        return view('todo.store');
    }

    public function edit(Request $request, $id){
        $todo = Todo::find($id);
        return view('todo.edit', ['todo' => $todo]);
    }

    public function update(Request $request){
        $todo = Todo::find($request->id);
        $todo->title = $request->title;
        $todo->explanation = $request->explanation;
        $todo->difficulty = $request->difficulty;
        $todo->importance = $request->importance;
        $todo->deadline = $request->deadline;
        if($request->deadline_time){
            $todo->deadline_time = $request->deadline_time;
        }
        $todo->save();

        return view('todo.update');
    }

    public function delete_confirm(Request $request, $id){
        $todo = Todo::find($id);
        return view('todo.delete_confirm', ['todo' => $todo]);
    }

    public function delete(Request $request){
        Todo::destroy($request->id);
        return view('todo.delete');
    }

    public function complete_confirm(Request $request, $id){
        $todo = Todo::find($id);
        return view('todo.complete_confirm', ['todo' => $todo]);
    }

    public function complete(Request $request){
        $todo = Todo::find($request->id);
        $todo->complete = true;
        $todo->completed_date = date("Y-m-d");
        $todo->completed_time = date("H:i:s");
        $todo->save();
        return view('todo.complete');
    }
}
