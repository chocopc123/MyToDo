<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller{
    public function register_form(){
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
        return view('user.login_form');
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|string|max:254',
            'password'=>'required|string|min:8|max:128',
        ]);
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            return redirect()->intended('profile');
        }
        return redirect('login');
    }

    public function profile(){
        return view('user.profile');
    }
}
