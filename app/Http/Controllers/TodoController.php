<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::where('complete', false)->orderBy('created_at', 'desc')->get();
        return view('todo.index', ['todos' => $todos]);
    }

    public function index_completed(){
        $todos = Todo::where('complete', true)->orderBy('created_at', 'desc')->get();
        return view('todo.index_completed', ['todos' => $todos]);
    }

    public function create(){
        return view('todo.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|string|max:70',
            'explanation'=>'required|string',
            'difficulty'=>'required|integer|max:3',
            'importance'=>'required|integer|max:3',
            'deadline'=>'required|string',
        ]);
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
        $request->validate([
            'title'=>'required|string|max:70',
            'explanation'=>'required|string',
            'difficulty'=>'required|integer|max:3',
            'importance'=>'required|integer|max:3',
            'deadline'=>'required|string',
        ]);
        $todo = Todo::find($request->id);
        $todo->title = $request->title;
        $todo->explanation = $request->explanation;
        $todo->difficulty = $request->difficulty;
        $todo->importance = $request->importance;
        $todo->deadline = $request->deadline;
        if($request->deadline_time){
            $todo->deadline_time = $request->deadline_time;
        }
        if($request->completed_date){
            $todo->completed_date = $request->completed_date;
        }
        if($request->completed_time){
            $todo->completed_time = $request->completed_time;
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

    public function release_confirm(Request $request, $id){
        $todo = Todo::find($id);
        return view('todo.release_confirm', ['todo' => $todo]);
    }

    public function release(Request $request){
        $todo = Todo::find($request->id);
        $todo->complete = false;
        $todo->completed_date = null;
        $todo->completed_time = null;
        $todo->save();
        return view('todo.release');
    }
}
