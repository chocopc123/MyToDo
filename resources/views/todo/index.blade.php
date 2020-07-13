<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>ToDo一覧|MyToDo</title>
  </head>
  <body class="p-3">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;"">
      <a class="navbar-brand" href="/">ToDoリスト</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">未達成リスト <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/index_completed">達成リスト</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <p class="pt-3"><a href="/create" class="btn btn-primary">ToDo追加</a></p>
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
              <h6 card-subtitle mb-2 text-muted>目標期限：{{$todo->deadline. " ". substr($todo->deadline_time, 0, 5)}}</h6>
            @else
              <h6 card-subtitle mb-2 text-muted>目標期限：{{$todo->deadline}}</h6>
            @endif
            <h6 card-subtitle mb-2 text-muted>作成日時：{{($todo->created_at)->format('Y-m-d H:i')}}</h6>
            <p><a href="/complete_confirm/{{$todo->id}}" class="btn btn-success">達成</a></p>
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
