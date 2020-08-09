<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Refine;
use App\Library\Sort;

class FolderRefineSortController extends Controller
{
    // folder_index_formの絞り込み、並べ替え

    // 絞り込み条件をリセットする
    public function folder_index_all($folder_id){
        // refineセッションをリセット
        Refine::reset_refine();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }

    // 絞り込み条件に期限間近をセットする
    public function folder_index_duesoon($folder_id){
        // refineセッションに値をセット
        Refine::set_refine_duesoon();
        // リダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }

    // 絞り込み条件に期限超過をセットする
    public function folder_index_overdue($folder_id){
        // refineセッションに値をセット
        Refine::set_refine_overdue();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }

    // 並べ替え条件に作成日時をセットする
    public function folder_index_created_at($folder_id){
        // sortセッションに値をセット
        Sort::set_sort_created_at();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }

    // 並べ替え条件に目標期限をセットする
    public function folder_index_deadline($folder_id){
        // sortセッションに値をセット
        Sort::set_sort_deadline();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }

    // 並べ替え条件に難易度をセットする
    public function folder_index_difficulty($folder_id){
        // sortセッションに値をセット
        Sort::set_sort_difficulty();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }

    // 並べ替え条件に重要度をセットする
    public function folder_index_importance($folder_id){
        // sortセッションに値をセット
        Sort::set_sort_importance();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }

    // 並べ替え条件に達成日時をセットする
    public function folder_index_completed_date($folder_id){
        // sortセッションに値をセット
        Sort::set_sort_completed_date();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }


    // add_folder_formの絞り込み

    // 絞り込み条件をリセットする
    public function add_folder_all($folder_id){
        // refineセッションをリセット
        Refine::reset_refine();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }

    // 絞り込み条件に期限間近をセットする
    public function add_folder_duesoon($folder_id){
        // refineセッションに値をセット
        Refine::set_refine_duesoon();
        // リダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }

    // 絞り込み条件に期限超過をセットする
    public function add_folder_overdue($folder_id){
        // refineセッションに値をセット
        Refine::set_refine_overdue();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }

    // add_folder_formの並べ替え

    // 並べ替え条件に作成日時をセットする
    public function add_folder_created_at($folder_id){
        // sortセッションに値をセット
        Sort::set_sort_created_at();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }

    // 並べ替え条件に目標期限をセットする
    public function add_folder_deadline($folder_id){
        // sortセッションに値をセット
        Sort::set_sort_deadline();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }

    // 並べ替え条件に難易度をセットする
    public function add_folder_difficulty($folder_id){
        // sortセッションに値をセット
        Sort::set_sort_difficulty();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }

    // 並べ替え条件に重要度をセットする
    public function add_folder_importance($folder_id){
        // sortセッションに値をセット
        Sort::set_sort_importance();
        // redirectセッションの値によってリダイレクトする
        return redirect( session('folder_redirect'). $folder_id );
    }
}
