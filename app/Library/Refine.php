<?php

namespace App\Library;
use App;
use App\Todo;
use Illuminate\Support\Facades\Auth;

class Refine{
  public static function reset_refine(){
    // refineセッションに値を設定
    session(['refine'=> "/"]);
  }

  public static function set_refine_duesoon(){
    // refineセッションに値を設定
    session(['refine'=> "/duesoon"]);
  }

  public static function set_refine_overdue(){
    // refineセッションに値を設定
    session(['refine'=> "/overdue"]);
  }

  public static function default($complete, $request) {
    $todos = Todo::where([
      ['user_id', Auth::id()], ['complete', $complete],
    ])
    // あいまい検索
    ->where(function($todos) use($request){
      $todos->where('title', 'like', '%'. $request->search.'%')
        ->orwhere('explanation', 'like', '%'. $request->search. '%');
    })
    // 並べ替え
    ->orderBy(session('sort'), session('order'))
    ->orderBy('deadline_time', session('order'))
    ->paginate(5);
    return $todos;
  }

  public static function duesoon($complete, $request){
    $todos = Todo::where(function($todos) use($complete){
      $todos->where('user_id', Auth::id())
        ->where('complete', $complete)
        ->where('deadline', '<' , date("Y-m-d", strtotime('+4 day')));
    })
    // あいまい検索
    ->where(function($todos) use($request){
      $todos->where('title', 'like', '%'. $request->search. '%')
        ->orwhere('explanation', 'like', '%'. $request->search. '%');
    })
    // 期限の判定
    ->where(function($todos){
      $todos->where('deadline', '>' , date("Y-m-d"))
      ->orwhere(function($todos){
        $todos->where('deadline', '=' , date("Y-m-d"))
          ->where('deadline_time', '>', date("H:i:s"));
      })->orwhere(function($todos){
        $todos->where('deadline', '=', date("Y-m-d"))
          ->whereNull('deadline_time');
      });
    })
    // 並べ替え
    ->orderBy(session('sort'), session('order'))
    ->orderBy('deadline_time', session('order'))
    ->paginate(5);
    return $todos;
  }

  public static function overdue($complete = false, $request){
    $todos = Todo::where(function($todos) use($complete){
      $todos->where('user_id', Auth::id())
        ->where('complete', $complete);
    })
    // あいまい検索
    ->where(function($todos) use($request){
      $todos->where('title', 'like', '%'. $request->search. '%')
        ->orwhere('explanation', 'like', '%'. $request->search. '%');
    })
    // 期限の判定
    ->where(function($todos){
      $todos->where('deadline', '<' , date("Y-m-d"))
      ->orwhere(function($todos){
        $todos->where('deadline', '=' , date("Y-m-d"))
          ->where('deadline_time', '<', date("H:i:s"));
      });
    })
    // 並べ替え
    ->orderBy(session('sort'), session('order'))
    ->orderBy('deadline_time', session('order'))
    ->paginate(5);
    return $todos;
  }

  public static function completed_overdue($complete = true, $request){
    $todos = Todo::where(function($todos){
      $todos->where('user_id', Auth::id())
        ->where('complete', true);
    })
    // あいまい検索
    ->where(function($todos) use($request){
      $todos->where('title', 'like', '%'. $request->search. '%')
        ->orwhere('explanation', 'like', '%'. $request->search. '%');
    })
    // 期限の判定
    ->where(function($todos){
      $todos->whereColumn('deadline', '<' , 'completed_date')
      ->orwhere(function($todos){
        $todos->whereColumn('deadline', '=' , 'completed_date')
          ->whereColumn('deadline_time', '<', 'completed_time');
      });
    })
    // 並べ替え
    ->orderBy(session('sort'), session('order'))
    ->orderBy('deadline_time', session('order'))
    ->paginate(5);
    return $todos;
  }
}