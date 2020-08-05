<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Library\BaseClass;
use App\Library\Refine;
use App\Library\Sort;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller{
    public function __construct(){
        // ログインしていないとアクションにアクセス出来ないようにする
        $this->middleware('auth');
        // セッションの初期値を設定
        session(['refine' => '/']);
        session(['sort' => 'created_at']);
        session(['order' => 'desc']);
    }

    public function index(Request $request){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // completedセッションに値を設定
        session(['completed' => false]);
        // redirectセッションに値を設定
        session(['redirect' => '/']);
        // sortに'completed_date'が入っている場合は'created_at'に変更
        if(session('sort') == 'completed_date'):
            session(['sort' => 'created_at']);
        endif;

        // ログインユーザーの未達成のToDo一覧を絞り込んで取得
        if(session('refine') == '/'):
            $todos = Refine::default(false, $request)->paginate(5);
        elseif(session('refine') == '/duesoon'):
            $todos = Refine::duesoon(false, $request)->paginate(5);
        elseif(session('refine') == '/overdue'):
            $todos = Refine::overdue(false, $request)->paginate(5);
        endif;

        // $todosを渡してindexビューを返す
        return view('todo.index', ['todos' => $todos, 'search' => $request->search, 'folders' => $folders]);
    }


    public function index_completed(Request $request){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // completedセッションに値を設定
        session(['completed' => true]);
        // redirectセッションに値を設定
        session(['redirect' => '/index_completed']);
        // refineに'/duesoon'が入っている場合は'/'に変更
        if(session('refine') == '/duesoon'):
            session(['refine' => '/']);
        endif;

        // ログインユーザーの達成済みのToDo一覧を絞り込んで取得
        if(session('refine') == '/'):
            $todos = Refine::default(true, $request)->paginate(5);
        elseif(session('refine') == '/overdue'):
            $todos = Refine::completed_overdue(true, $request)->paginate(5);
        endif;

        // $todosを渡してindex_completedビューを返す
        return view('todo.index_completed', ['todos' => $todos, 'folders' => $folders]);
    }

    // 絞り込み条件をリセットする
    public function index_all(){
        // refineセッションをリセット
        Refine::reset_refine();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('redirect') );
    }

    // 絞り込み条件に期限間近をセットする
    public function duesoon(){
        // refineセッションに値をセット
        Refine::set_refine_duesoon();
        // リダイレクトする
        return redirect('/');
    }

    // 絞り込み条件に期限超過をセットする
    public function overdue(){
        // refineセッションに値をセット
        Refine::set_refine_overdue();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('redirect') );
    }

    // 並べ替え条件に作成日時をセットする
    public function index_created_at(){
        // sortセッションに値をセット
        Sort::set_sort_created_at();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('redirect') );
    }

    // 並べ替え条件に目標期限をセットする
    public function index_deadline(){
        // sortセッションに値をセット
        Sort::set_sort_deadline();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('redirect') );
    }

    // 並べ替え条件に難易度をセットする
    public function index_difficulty(){
        // sortセッションに値をセット
        Sort::set_sort_difficulty();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('redirect') );
    }

    // 並べ替え条件に重要度をセットする
    public function index_importance(){
        // sortセッションに値をセット
        Sort::set_sort_importance();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('redirect') );
    }

    // 並べ替え条件に達成日時をセットする
    public function index_completed_date(){
        // sortセッションに値をセット
        Sort::set_sort_completed_date();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('redirect') );
    }


    public function create(){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // createビューを返す
        return view('todo.create', ['folders' => $folders]);
    }


    public function store(Request $request){
        // バリデーションを設定する
        $request->validate([
            'title'=>'required|string|max:40',
            'explanation'=>'nullable|string|max:500',
            'difficulty'=>'required|integer|max:3',
            'importance'=>'required|integer|max:3',
            'deadline'=>'required|string|max:10',
            'deadline_time'=>'nullable|string',
            'folder_id'=>'required|integer',
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
        if($request->deadline_time):
            $todo->deadline_time = $request->deadline_time;
        endif;
        $todo->folder_id = $request->folder_id;
        // データベースに保存
        $todo->save();
        // flash_messageセッションにメッセージを代入
        session()->flash('flash_message', 'ToDoの追加が完了しました');
        // リダイレクトする
        return redirect('/');
    }


    public function edit(Request $request, $id){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // $idをもつToDoを抜き出す
        $todo = Todo::find($id);
        // $todoを渡してeditビューを返す
        return view('todo.edit', ['todo' => $todo, 'folders' => $folders]);
    }


    public function update(Request $request){
        // バリデーションを設定する
        $request->validate([
            'title'=>'required|string|max:40',
            'explanation'=>'nullable|string|max:500',
            'difficulty'=>'required|integer|max:3',
            'importance'=>'required|integer|max:3',
            'deadline'=>'required|string|max:10',
            'deadline_time'=>'nullable|string|max:8',
            'completed_date'=>'filled|string|max:10',
            'completed_time'=>'filled|string|max:8',
            'folder_id'=>'required|integer',
        ]);
        // $todoに値を設定する
        $todo = Todo::find($request->id);
        $todo->title = $request->title;
        $todo->explanation = $request->explanation;
        $todo->difficulty = $request->difficulty;
        $todo->importance = $request->importance;
        $todo->deadline = $request->deadline;
        // deadline_timeが送られてきた場合は設定する
        if($request->deadline_time):
            $todo->deadline_time = $request->deadline_time;
        endif;
        // completed_dateが送られてきた場合は設定する
        if($request->completed_date):
            $todo->completed_date = $request->completed_date;
        endif;
        // completed_timeが送られてきた場合は設定する
        if($request->completed_time):
            $todo->completed_time = $request->completed_time;
        endif;
        $todo->folder_id = $request->folder_id;
        // データベースに保存
        $todo->save();
        // flash_messageセッションにメッセージを代入
        session()->flash('flash_message', 'ToDoの編集が完了しました');
        // redirectセッションの値によってリダイレクトする
        return redirect( session('redirect') );
    }


    public function delete_confirm(Request $request, $id){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // $idをもつToDoを抜き出す
        $todo = Todo::find($id);
        // $todoを渡してdelete_confirmビューを返す
        return view('todo.delete_confirm', ['todo' => $todo, 'folders' => $folders]);
    }


    public function delete(Request $request){
        // 受け取ったidのToDoを削除する
        Todo::where('id', $request->id)->delete();
        // flash_messageセッションにメッセージを代入
        session()->flash('flash_message', '削除が完了しました');
        // redirectセッションの値によってリダイレクトする
        return redirect( session('redirect') );
    }


    public function complete_confirm(Request $request, $id){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // $idをもつToDoを抜き出す
        $todo = Todo::find($id);
        // $todoを渡してcomplete_confirmビューを返す
        return view('todo.complete_confirm', ['todo' => $todo, 'folders' => $folders]);
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
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // $idをもつToDoを抜き出す
        $todo = Todo::find($id);
        // $todoを渡してrelease_confirmビューを返す
        return view('todo.release_confirm', ['todo' => $todo, 'folders' => $folders]);
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
