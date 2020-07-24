<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\Todo;
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
        session()->flash('flash_message', 'フォルダ新規登録作成が完了しました');
        return redirect( session('redirect') );
    }

    public function folder_index(Request $request, $id){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // フォルダを取得
        if($folder = Folder::find($id)):
            // フォルダのTodo一覧を取得
            $todos = Todo::where('folder_id', $folder->id)
                ->where('title', 'like', '%'. $request->search. '%')
                ->orderBy('created_at', 'desc')
            ->paginate(5);
            return view('folder.folder_index', ['todos' => $todos, 'folders' => $folders, 'search' => $request->search, 'fold' => $folder]);
        else:
            session()->flash('flash_message', '存在しないフォルダです');
            return redirect( session('redirect') );
        endif;
    }

    public function add_folder_form(Request $request, $id){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // フォルダを取得
        if($folder = Folder::find($id)):
            // ToDo一覧を取得
            $todos = Todo::where('user_id', Auth::id())
                ->where('title', 'like', '%'. $request->search. '%')
                ->where('folder_id', '=', 0)
                ->orderBy('created_at', 'desc')
            ->paginate(5);
            return view('folder.add_folder_form', ['todos' => $todos, 'folders' => $folders, 'search' => $request->search, 'fold' => $folder]);
        else:
            session()->flash('flash_message', '存在しないフォルダです');
            return redirect( session('redirect') );
        endif;
    }

    public function add_folder(Request $request, $folder_id, $todo_id){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // フォルダを取得
        if($folder = Folder::find($folder_id)):
            $todo = Todo::find($todo_id);
            $todo->folder_id = $folder_id;
            $todo->save();
            session()->flash('flash_message', $folder->name. 'フォルダにToDoを追加しました');
            return redirect( '/folder_index/'. $folder_id );
        else:
            session()->flash('flash_message', '存在しないフォルダです');
            return redirect( session('redirect') );
        endif;
    }
}
