<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>ToDo達成解除|MyToDo</title>
  </head>
  <body class="p-3">
    <h3>ToDo達成解除</h3>
    <div class="card mb-2">
      <div class="card-body">
        <h4 class="card-title">{{$todo->title}}</h4>
        <p>{!! nl2br(e($todo->explanation)) !!}</p>
        <h6 card-subtitle mb-2 text-muted>難易度：{{$todo->difficulty}}</h6>
        <h6 card-subtitle mb-2 text-muted>重要度：{{$todo->importance}}</h6>
        @if($todo->deadline_time)
          <h6 card-subtitle mb-2 text-muted>目標期限：{{$todo->deadline. " ". $todo->deadline_time}}</h6>
        @else
          <h6 card-subtitle mb-2 text-muted>目標期限：{{$todo->deadline}}</h6>
        @endif
        <h6 card-subtitle mb-2 text-muted>作成日時：{{($todo->created_at)->format('Y-m-d')}}</h6>
        <h6 card-subtitle mb-2 text-muted>達成日時：{{$todo->completed_date. " ". $todo->completed_time}}</h6>
      </div>
    </div>
    <p>解除されたToDoはToDoリストに移動されます。</p>
    <div style="display:inline-flex">
      <form method="POST" action="/release">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$todo->id}}">
        <input type="submit" class="btn btn-warning" value="解除">
      </form>
    </div>
    <a href="/index_completed" class="btn btn-primary">一覧に戻る</a>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
