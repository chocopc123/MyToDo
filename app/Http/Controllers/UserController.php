<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller{
    public function __construct(){
        // ログインしていないとlogoutとprofileにはアクセス出来ないようにする
        $this->middleware('auth', ['only' => ['logout', 'profile']]);
        // ログインしていたらlogoutとprofile以外にはアクセスできないようにする
        $this->middleware('guest', ['except' => ['logout', 'profile']]);
    }

    public function register_form(){
        // registerビューを返す
        return view('user.register_form');
    }

    public function register(Request $request){
        // バリデーションを設定する
        $request->validate([
            'name'=>'required|string|max:30',
            'email'=>'required|string|max:254',
            'password'=>'required|string|min:8|max:128|confirmed',
        ]);
        // $userに値を設定する
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        // データベースに保存
        $user->save();
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
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            // ログイン後にアクセスしようとしていたアクションにリダイレクト、無い場合はprofileへ
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
}
