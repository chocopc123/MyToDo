<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Refine;
use App\Library\Sort;

class TodoRefineSortController extends Controller
{
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
}
