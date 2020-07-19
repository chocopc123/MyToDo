<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller{
    public function __construct(){
        // ログインしていないとアクションにアクセス出来ないようにする
        $this->middleware('auth');
    }

    public function index(){
        // completedセッションに値を設定
        session(['completed' => false]);
        // redirectセッションに値を設定
        session(['redirect' => "/"]);
        // ログインユーザーの未達成のToDo一覧を作成日時の降順で取得
        $todos = Todo::where([
            ['user_id', Auth::id()], ['complete', false]
            ])->orderBy('created_at', 'desc')
            ->paginate(20);
        // $todosを渡してindexビューを返す
        return view('todo.index', ['todos' => $todos]);
    }


    public function index_completed(){
        // completedセッションに値を設定
        session(['completed' => true]);
        // redirectセッションに値を設定
        session(['redirect' => "/index_completed"]);
        // ログインユーザーの達成済みのToDo一覧を作成日時の降順で取得
        $todos = Todo::where([
            ['user_id', Auth::id()], ['complete', true]
            ])->orderBy('created_at', 'desc')
            ->get();
        // $todosを渡してindex_completedビューを返す
        return view('todo.index_completed', ['todos' => $todos]);
    }

    public function duesoon(){
        // redirectセッションに値を設定
        session(['redirect'=> "/duesoon"]);
        // ログインユーザーの未達成で期限間近のToDo一覧を作成日時の降順で取得
        $todos = Todo::where(function($todos){
            $todos->where('user_id', Auth::id())
                ->where('complete', false)
                ->where('deadline', '<' , date("Y-m-d", strtotime('+4 day'))
            );
        })
        ->where(function($todos){
            $todos->where('deadline', '>' , date("Y-m-d"))
            ->orwhere(function($todos){
                $todos->where('deadline', '=' , date("Y-m-d"))
                    ->where('deadline_time', '>', date("H:i:s"));
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(20);
        return view('todo.index', ['todos' => $todos]);
    }


    public function create(){
        // createビューを返す
        return view('todo.create');
    }


    public function store(Request $request){
        // バリデーションを設定する
        $request->validate([
            'title'=>'required|string|max:40',
            'explanation'=>'required|string|max:500',
            'difficulty'=>'required|integer|max:3',
            'importance'=>'required|integer|max:3',
            'deadline'=>'required|string|max:10',
            'deadline_time'=>'nullable|string',
        ]);
        // $todoに値を設定する
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->explanation = $request->explanation;
        $todo->difficulty = $request->difficulty;
        $todo->importance = $request->importance;
        $todo->complete = false;
        $todo->deadline = $request->deadline;
        $todo->user_id = Auth::id();
        // deadline_timeが送られてきた場合は設定する
        if($request->deadline_time){
            $todo->deadline_time = $request->deadline_time;
        }
        // データベースに保存
        $todo->save();
        // flash_messageセッションにメッセージを代入
        session()->flash('flash_message', 'ToDoの追加が完了しました');
        // リダイレクトする
        return redirect('/');
    }


    public function edit(Request $request, $id){
        // $idをもつToDoを抜き出す
        $todo = Todo::find($id);
        // $todoを渡してeditビューを返す
        return view('todo.edit', ['todo' => $todo]);
    }


    public function update(Request $request){
        // バリデーションを設定する
        $request->validate([
            'title'=>'required|string|max:40',
            'explanation'=>'required|string|max:500',
            'difficulty'=>'required|integer|max:3',
            'importance'=>'required|integer|max:3',
            'deadline'=>'required|string|max:10',
            'deadline_time'=>'nullable|string|max:8',
            'completed_date'=>'filled|string|max:10',
            'completed_time'=>'filled|string|max:8',
        ]);
        // $todoに値を設定する
        $todo = Todo::find($request->id);
        $todo->title = $request->title;
        $todo->explanation = $request->explanation;
        $todo->difficulty = $request->difficulty;
        $todo->importance = $request->importance;
        $todo->deadline = $request->deadline;
        // deadline_timeが送られてきた場合は設定する
        if($request->deadline_time){
            $todo->deadline_time = $request->deadline_time;
        }
        // completed_dateが送られてきた場合は設定する
        if($request->completed_date){
            $todo->completed_date = $request->completed_date;
        }
        // completed_timeが送られてきた場合は設定する
        if($request->completed_time){
            $todo->completed_time = $request->completed_time;
        }
        // データベースに保存
        $todo->save();
        // flash_messageセッションにメッセージを代入
        session()->flash('flash_message', 'ToDoの編集が完了しました');
        // session('completed')がtrueだったらindex_completedにリダイレクトする
        if(session('completed')){
            return redirect('/index_completed');
        }else{
            return redirect('/');
        }
    }


    public function delete_confirm(Request $request, $id){
        // $idをもつToDoを抜き出す
        $todo = Todo::find($id);
        // $todoを渡してdelete_confirmビューを返す
        return view('todo.delete_confirm', ['todo' => $todo]);
    }


    public function delete(Request $request){
        // 受け取ったidのToDoを削除する
        Todo::where('id', $request->id)->delete();
        // flash_messageセッションにメッセージを代入
        session()->flash('flash_message', '削除が完了しました');
        // session('completed')がtrueだったらindex_completedにリダイレクトする
        if(session('completed')){
            return redirect('/index_completed');
        }else{
            return redirect('/');
        }
    }


    public function complete_confirm(Request $request, $id){
        // $idをもつToDoを抜き出す
        $todo = Todo::find($id);
        // $todoを渡してcomplete_confirmビューを返す
        return view('todo.complete_confirm', ['todo' => $todo]);
    }


    public function complete(Request $request){
        // $idをもつToDoを抜き出す
        $todo = Todo::find($request->id);
        // 値を設定する
        $todo->complete = true;
        $todo->completed_date = date("Y-m-d");
        $todo->completed_time = date("H:i:s");
        // データベースに保存する
        $todo->save();
        // flash_messageセッションにメッセージを代入
        session()->flash('flash_message', 'ToDoを達成しました');
        // リダイレクトする
        return redirect('/');
    }


    public function release_confirm(Request $request, $id){
        // $idをもつToDoを抜き出す
        $todo = Todo::find($id);
        // $todoを渡してrelease_confirmビューを返す
        return view('todo.release_confirm', ['todo' => $todo]);
    }


    public function release(Request $request){
        // $idをもつToDoを抜き出す
        $todo = Todo::find($request->id);
        // 値を設定する
        $todo->complete = false;
        $todo->completed_date = null;
        $todo->completed_time = null;
        // データベースに保存する
        $todo->save();
        // flash_messageセッションにメッセージを代入
        session()->flash('flash_message', 'ToDoの達成状態を解除しました');
        // リダイレクトする
        return redirect('/index_completed');
    }
}
