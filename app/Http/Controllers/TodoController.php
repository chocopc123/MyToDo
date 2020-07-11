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
}
