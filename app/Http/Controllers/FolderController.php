<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\Library\BaseClass;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function folder_create_form(){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        return view('folder.folder_create_form', ['folders' => $folders]);
    }

    public function folder_create(Request $request){
        $request->validate([
            'name'=>'required|string|max:30',
        ]);
        // $folderに値を設定する
        $folder = new Folder;
        $folder->name = $request->name;
        $folder->user_id = Auth::id();
        $folder->save();
        return redirect( session('redirect') );
    }
}
