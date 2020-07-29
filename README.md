# MyToDo
難易度や重要度、目標期限を自分で決め、優先順位をつけることで、取り組むべき課題を先延ばしにしないToDoリスト

# ロゴ<br>

<img src="https://github.com/chocopc123/MyToDo/blob/master/public/image/mytodo.png" width="50">  <img src="https://github.com/chocopc123/MyToDo/blob/master/public/image/mytodo_icon.png" width="200">

# Environment

* Vagrant
* Laravel Homestead 10.10.1
* PHP 7.4.5
* Laravel Framework 6.18.31
 
# 機能

* ユーザー新規作成
* ユーザーログイン
* ユーザープロフィール
* ユーザー削除
* ToDo作成
* ToDo達成
* ToDo達成解除
* ToDo修正
* ToDo削除
* ToDo検索機能
  * ToDoのタイトルと詳細をあいまい検索
* 未達成リスト/達成リスト
  * 目標期限と現在日時/達成日時を比較して、メッセージや色を変更する
* 絞り込み
  * 期限間近/期限超過
* 並べ替え
  * 作成日時/期限/難易度/重要度
  * 同じボタンをもう一回おすと昇順/降順切り替え
* フォルダ新規作成
* フォルダ詳細
* フォルダへToDo追加
  
# 仕様

* Authミドルウェア
  * Illuminate\Support\Facades\Authをuseしています
  * php artisan make:authコマンドは利用していません
* ソフトデリート
  * Todo/User/Folderモデルに適用しています

# 間に合わなかった機能
 
* フォルダ削除機能
* フォルダに追加したToDoを解除できるようにする
* ToDo作成時にフォルダを選択し、追加できるようにする
* フォルダ内ToDoの絞り込み、並べ替え
* フォルダへの追加時のToDo一覧の絞り込み、並べ替え
 
# Author
 
* 原山 隆玖
* harayama1949509@gmail.com
