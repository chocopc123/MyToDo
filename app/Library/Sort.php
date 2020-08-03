<?php

namespace App\Library;
use App;

class Sort{
  public static function set_sort_created_at() {
    // sortに既にcreated_atが設定されている場合は並び順を反転
    if(session('sort') == 'created_at'):
      if(session('order') == 'desc'):
        session(['order' => 'asc']);
      elseif(session('order') == 'asc'):
        session(['order' => 'desc']);
      endif;
    // sortにcreated_atが設定されていなかったら設定 & 並び順の初期化
    else:
      // sortにcreated_atを設定
      session(['sort' => 'created_at']);
      // 並び順をdescに設定
      session(['order' => 'desc']);
    endif;
  }

  public static function set_sort_deadline(){
    // sortに既にdeadlineが設定されている場合は並び順を反転
    if(session('sort') == 'deadline'):
      if(session('order') == 'desc'):
        session(['order' => 'asc']);
      elseif(session('order') == 'asc'):
        session(['order' => 'desc']);
      endif;
    // sortにdeadlineが設定されていなかったら設定 & 並び順の初期化
    else:
      // sortにdeadlineを設定
      session(['sort' => 'deadline']);
      // 並び順をascに設定
      session(['order' => 'asc']);
    endif;
  }

  public static function set_sort_difficulty(){
    // sortに既にdifficiltyが設定されている場合は並び順を反転
    if(session('sort') == 'difficulty'):
      if(session('order') == 'desc'):
        session(['order' => 'asc']);
      elseif(session('order') == 'asc'):
        session(['order' => 'desc']);
      endif;
    // sortにdifficultyが設定されていなかったら設定 & 並び順の初期化
    else:
      // sortにdifficultyを設定
      session(['sort' => 'difficulty']);
      // 並び順をascに設定
      session(['order' => 'asc']);
    endif;
  }

  public static function set_sort_importance(){
    // sortに既にimportanceが設定されている場合は並び順を反転
    if(session('sort') == 'importance'):
      if(session('order') == 'desc'):
        session(['order' => 'asc']);
      elseif(session('order') == 'asc'):
        session(['order' => 'desc']);
      endif;
    // sortにimportanceが設定されていなかったら設定 & 並び順の初期化
    else:
      // sortにimportanceを設定
      session(['sort' => 'importance']);
      // 並び順をascに設定
      session(['order' => 'asc']);
    endif;
  }

  public static function set_sort_completed_date(){
    // sortに既にcompleted_dateが設定されている場合は並び順を反転
    if(session('sort') == 'completed_date'):
      if(session('order') == 'desc'):
        session(['order' => 'asc']);
      elseif(session('order') == 'asc'):
        session(['order' => 'desc']);
      endif;
    // sortにcompleted_dateが設定されていなかったら設定 & 並び順の初期化
    else:
      // sortにcompleted_dateを設定
      session(['sort' => 'completed_date']);
      // 並び順をascに設定
      session(['order' => 'asc']);
    endif;
  }
}