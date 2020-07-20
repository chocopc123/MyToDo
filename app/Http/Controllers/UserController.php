<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Todo;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{
    public function __construct(){
        // ログインしていないとlogoutとprofileにはアクセス出来ないようにする
        $this->middleware('auth', ['only' => ['logout', 'profile', 'user_delete_confirm', 'user_delete']]);
        // ログインしていたらlogoutとprofile以外にはアクセスできないようにする
        $this->middleware('guest', ['except' => ['logout', 'profile', 'user_delete_confirm', 'user_delete']]);
    }

    public function register_form(){
        // registerビューを返す
        return view('user.register_form');
    }

    public function register(Request $request){
        // バリデーションを設定する
        $request->validate([
            'name'=>'required|string|max:30',
            'email'=>'required|string|max:254|unique:users,email',
            'password'=>'required|string|min:8|max:128|confirmed',
        ]);
        // $userに値を設定する
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        // データベースに保存
        $user->save();
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            // ログイン後にアクセスしようとしていたアクションにリダイレクト、無い場合はprofileへ
            session()->flash('flash_message', 'ユーザー新規登録が完了しました');
            return redirect()->intended('profile');
        }
        // リダイレクトする
        return redirect('/');
    }

    public function login_form(){
        // login_formビューを返す
        return view('user.login_form');
    }

    public function login(Request $request){
        // バリデーションを設定する
        $request->validate([
            'email'=>'required|string|max:254',
            'password'=>'required|string|min:8|max:128',
        ]);
        // ログインする
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->remember)){
            // ログイン後にアクセスしようとしていたアクションにリダイレクト、無い場合はprofileへ
            session()->flash('flash_message', 'ログインしました');
            return redirect()->intended('profile');
        }
        // 失敗した場合はloginにリダイレクト
        return redirect('login');
    }

    public function profile(){
        // profileビューを返す
        return view('user.profile');
    }

    public function logout(){
        // ログアウトする
        Auth::logout();
        // ログインビューを返す
        return redirect('login');
    }

    public function user_delete_confirm(Request $request, $id){
        // $idをもつユーザーを抜き出す
        $user = User::find($id);
        // $userを渡してdelete_confirmビューを返す
        return view('user.user_delete_confirm', ['user' => $user]);
    }

    public function user_delete(Request $request){
        // ユーザーに対応したToDoをソフトデリートする
        Todo::where('user_id', $request->id)->delete();
        // 受け取ったidのUserを削除する
        User::where('id', $request->id)->delete();
        // ログアウト
        Auth::logout();
        // フラッシュメッセージの表示
        session()->flash('flash_message', 'ユーザーの削除が完了しました');
        return redirect('/register');
    }
}
