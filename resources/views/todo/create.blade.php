<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>ToDo追加|MyToDo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Bootstrap本体 -->
  </head>
  <body class="px-3">
    <h3>ToDo追加</h3>

    <form method="POST" action="/create">
      {{ csrf_field() }}
      <div class="form-group">
        <label>タイトル<input type="text" class="form-control" name="title"></label>
      </div>
      <div class="form-group">
        <label>詳細<textarea class="form-control" name="explanation" cols="30" rows="10"></textarea></label>
      </div>
      <div class="form-group">
        <label>難易度<input type="range" name="difficulty" min="1" max="3" value="1"></label>
      </div>
      <div class="form-group">
        <label>重要度<input type="range" name="importance" min="1" max="3" value="1"></label>
      </div>
      <div class="form-group">
        <label>目標期限<input type="date" class="form-control" name="deadline"></label>
      </div>
        <input type="submit" class="btn btn-primary" value="追加"></li>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script><!-- Scripts（Jquery） -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Scripts（bootstrapのjavascript） -->
  </body>
</html>
