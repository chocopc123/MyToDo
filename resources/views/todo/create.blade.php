<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>ToDo追加|MyToDo</title>
  </head>
  <body class="p-3">
    <h3>ToDo追加</h3>

    <form method="POST" action="/create">
      {{ csrf_field() }}
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      <div class="form-group">
        <label for="titleInput">タイトル <span class="badge badge-danger">必須</span></label>
        <input type="text" class="form-control" id="titleInput" name="title" value="{{old('title')}}">
      </div>
      <div class="form-group">
        <label for="explanationInput">詳細 <span class="badge badge-danger">必須</span></label>
        <textarea class="form-control" id="explanationInput" name="explanation" cols="30" rows="10">{{old('explanation')}}</textarea>
      </div>
      <div class="form-group">
        @if(old('difficulty'))
          <label>難易度<input type="range" class="form-control-range" name="difficulty" min="1" max="3" value="{{old('difficulty')}}"></label>
        @else
          <label>難易度<input type="range" class="form-control-range" name="difficulty" min="1" max="3" value="1"></label>
        @endif
      </div>
      <div class="form-group">
        @if(old('importance'))
          <label>重要度<input type="range" class="form-control-range" name="importance" min="1" max="3" value="{{old('importance')}}"></label>
        @else
          <label>重要度<input type="range" class="form-control-range" name="importance" min="1" max="3" value="1"></label>
        @endif
      </div>
      <div class="form-group">
        @if(old('deadline'))
          <label>目標期限 <span class="badge badge-danger">必須</span><input type="date" class="form-control" name="deadline" value="{{old('deadline')}}"></label>
        @else
          <label>目標期限 <span class="badge badge-danger">必須</span><input type="date" class="form-control" name="deadline" value="{{date("Y-m-d")}}"></label>
        @endif
        <label>時刻 <span class="badge badge-info">任意</span><input type="time" class="form-control" name="deadline_time" value="{{old('deadline_time')}}"></label>
      </div>
      <input type="submit" class="btn btn-primary" value="追加"></li>
      <a href="/" class="btn btn-primary">一覧に戻る</a>
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
