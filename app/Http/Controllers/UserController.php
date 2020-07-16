<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function register_form(){
        return view('user.register_form');
    }

    public function register(Request $request){
        // バリデーションを設定する
        $request->validate([
            'name'=>'required|string|max:30',
            'email'=>'required|string|max:254',
            'password'=>'required|string|max:128|confirmed',
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
}
