<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\Todo;
use App\Library\BaseClass;
use App\Library\Refine;
use App\Library\Sort;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function __construct(){
    }

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
        return redirect('/folder/index/'.$folder->id);
    }

    public function folder_index(Request $request, $id){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // folder_redirectセッションに値を設定
        session(['folder_redirect' => '/folder/index/']);
        // sortに'completed_date'が入っている場合は'created_at'に変更
        if(session('sort') == 'completed_date'):
            session(['sort' => 'created_at']);
        endif;
        // フォルダを取得
        if($folder = Folder::find($id)):
            // ToDo一覧を取得
            if(session('refine') == '/'):
                $todos = Refine::default(false, $request)->where('folder_id', $folder->id)->paginate(5);
            elseif(session('refine') == '/duesoon'):
                $todos = Refine::duesoon(false, $request)->where('folder_id', $folder->id)->paginate(5);
            elseif(session('refine') == '/overdue'):
                $todos = Refine::overdue(false, $request)->where('folder_id', $folder->id)->paginate(5);
            endif;
            return view('folder.folder_index', ['todos' => $todos, 'folders' => $folders, 'search' => $request->search, 'fold' => $folder, 'completed' => false]);
        elseif($id == 0):
            $folder = new Folder;
            $folder->id = 0;
            $folder->name = '未設定';
            $folder->user_id = Auth::id();
            // ToDo一覧を取得
            if(session('refine') == '/'):
                $todos = Refine::default(false, $request)->where('folder_id', $folder->id)->paginate(5);
            elseif(session('refine') == '/duesoon'):
                $todos = Refine::duesoon(false, $request)->where('folder_id', $folder->id)->paginate(5);
            elseif(session('refine') == '/overdue'):
                $todos = Refine::overdue(false, $request)->where('folder_id', $folder->id)->paginate(5);
            endif;
            return view('folder.folder_index', ['todos' => $todos, 'folders' => $folders, 'search' => $request->search, 'fold' => $folder, 'completed' => false]);
        else:
            session()->flash('flash_message', '存在しないフォルダです');
            return redirect( session('redirect') );
        endif;
    }

    public function folder_index_completed(Request $request, $id){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // folder_redirectセッションに値を設定
        session(['folder_redirect' => '/folder/index_completed/']);
        // refineに'/duesoon'が入っている場合は'/'に変更
        if(session('refine') == '/duesoon'):
            session(['refine' => '/']);
        endif;
        // フォルダを取得
        if($folder = Folder::find($id)):
            // ToDo一覧を取得
            if(session('refine') == '/'):
                $todos = Refine::default(true, $request)->where('folder_id', $folder->id)->paginate(5);
            elseif(session('refine') == '/overdue'):
                $todos = Refine::completed_overdue(true, $request)->where('folder_id', $folder->id)->paginate(5);
            endif;
            return view('folder.folder_index_completed', ['todos' => $todos, 'folders' => $folders, 'search' => $request->search, 'fold' => $folder, 'completed' => true]);
        elseif($id == 0):
            $folder = new Folder;
            $folder->id = 0;
            $folder->name = '未設定';
            $folder->user_id = Auth::id();
            // ToDo一覧を取得
            if(session('refine') == '/'):
                $todos = Refine::default(true, $request)->where('folder_id', $folder->id)->paginate(5);
            elseif(session('refine') == '/overdue'):
                $todos = Refine::completed_overdue(true, $request)->where('folder_id', $folder->id)->paginate(5);
            endif;
            return view('folder.folder_index_completed', ['todos' => $todos, 'folders' => $folders, 'search' => $request->search, 'fold' => $folder, 'completed' => true]);
        else:
            session()->flash('flash_message', '存在しないフォルダです');
            return redirect( session('redirect') );
        endif;
    }

    public function add_folder_form(Request $request, $id){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // folder_redirectセッションに値を設定
        session(['folder_redirect' => '/folder/add_form/']);
        // フォルダを取得
        if($folder = Folder::find($id)):
            // ToDo一覧を取得
            if(session('refine') == '/'):
                $todos = Refine::default(false, $request)->where('folder_id', 0)->paginate(5);
            elseif(session('refine') == '/duesoon'):
                $todos = Refine::duesoon(false, $request)->where('folder_id', 0)->paginate(5);
            elseif(session('refine') == '/overdue'):
                $todos = Refine::overdue(false, $request)->where('folder_id', 0)->paginate(5);
            endif;
            return view('folder.add_folder_form', ['todos' => $todos, 'folders' => $folders, 'search' => $request->search, 'fold' => $folder, 'completed' => false]);
        else:
            session()->flash('flash_message', '存在しないフォルダです');
            return redirect( session('redirect') );
        endif;
    }

    public function add_folder_completed_form(Request $request, $id){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        session(['folder_redirect' => '/folder/add_completed_form/']);
        // フォルダを取得
        if($folder = Folder::find($id)):
            // ToDo一覧を取得
            if(session('refine') == '/'):
                $todos = Refine::default(true, $request)->where('folder_id', 0)->paginate(5);
            elseif(session('refine') == '/overdue'):
                $todos = Refine::completed_overdue(true, $request)->where('folder_id', 0)->paginate(5);
            endif;
            return view('folder.add_folder_completed_form', ['todos' => $todos, 'folders' => $folders, 'search' => $request->search, 'fold' => $folder, 'completed' => true]);
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
            return redirect( '/folder/index/'. $folder_id );
        else:
            session()->flash('flash_message', '存在しないフォルダです');
            return redirect( session('redirect') );
        endif;
    }

    public function delete_folder_confirm(Request $request, $folder_id){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // フォルダを取得
        $folder = Folder::find($folder_id);
        return view( 'folder.delete_folder_confirm', ['folders' => $folders, 'fold' => $folder] );
    }

    public function delete_folder(Request $request){
        // 受け取ったフォルダを削除する
        Folder::where('id', $request->id)->delete();
        Todo::where('folder_id', $request->id)
            ->update([
                'folder_id' => '0',
            ]);
        // flash_messageセッションを設定
        session()->flash('flash_message', 'フォルダの削除が完了しました');
        // redirectセッションの値によってリダイレクトする
        return redirect( session('redirect') );
    }

    public function folder_release_confirm(Request $request, $folder_id, $todo_id){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // フォルダを取得
        $folder = Folder::find($folder_id);
        // Todoを取得
        $todo = Todo::find($todo_id);
        return view( 'folder.folder_release_confirm', ['folders' => $folders, 'fold' => $folder, 'todo' => $todo] );
    }

    public function folder_release(Request $request){
        // フォルダ一覧を取得
        $folders = BaseClass::getfolders();
        // Todoを取得
        $todo = Todo::find($request->todo_id);
        $todo->folder_id = 0;
        $todo->save();
        return redirect( '/folder/index/'. $request->folder_id );
    }

}
