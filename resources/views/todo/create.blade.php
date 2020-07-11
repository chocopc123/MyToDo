<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ToDo追加|MyToDo</title>
    </head>
    <body>
        <h3>ToDo追加</h3>
        <form method="POST" action="/create">
          {{ csrf_field() }}
          <div>
            <ul>
              <li><label>タイトル<input type="text" name="title"></label></li>
              <li><label>詳細<textarea name="explanation" cols="30" rows="10"></textarea></label></li>
              <li><label>難易度<input type="range" name="difficulty" min="1" max="3" value="1"></label></li>
              <li><label>重要度<input type="range" name="importance" min="1" max="3" value="1"></label></li>
              <li><label>目標期限<input type="date" name="deadline"></label></li>
              <li><input type="submit" value="追加"></li>
            </ul>
          </div>
        </form>
    </body>
</html>
