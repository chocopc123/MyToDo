<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>ToDo一覧|MyToDo</title>
  </head>
  <body class="p-3">
    <h3>ToDoリスト</h3>
    <p><a href="/index_completed" class="btn btn-success">達成リスト  </a></p>
    <p><a href="/create" class="btn btn-primary">ToDo追加</a></p>

    @if(count($todos)==0)
      <h5>ToDoがまだありません。</h5>
    @else
      @foreach($todos as $todo)
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
            <p><a href="/complete_confirm/{{$todo->id}}" class="btn btn-primary">達成</a></p>
            <a href="/edit/{{$todo->id}}" class="card-link">修正</a>
            <a href="/delete_confirm/{{$todo->id}}" class="card-link">削除</a>
          </div>
        </div>
      @endforeach
    @endif

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
