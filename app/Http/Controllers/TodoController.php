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
        $todo->complete = $request->complete;
        $todo->save();

        return view('todo.store');
    }
}
