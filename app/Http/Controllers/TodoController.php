<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::all();
        return view('todo.index', ['todos' => $todos]);
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
        $todo->deadline = $request->deadline;
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
        $todo->save();

        return view('todo.update');
    }

    public function show(Request $request, $id){
        $todo = Todo::find($id);
        return view('todo.show', ['todo' => $todo]);
    }

    public function delete(Request $request){
        Todo::destroy($request->id);
        return view('todo.delete');
    }
}
