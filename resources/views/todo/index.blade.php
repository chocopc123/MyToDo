<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ToDo一覧|MyToDo</title>
    </head>
    <body>
        <h3>ToDo一覧</h3>
        <p><a href="/create">ToDo追加</a></p>
        @foreach($todos as $todo)
        <div>
            <h4>{{$todo->title}}</h4>
            <h6>{{$todo->explanation}}</h6>
            <h6>{{$todo->difficulty}}</h6>
            <h6>{{$todo->importance}}</h6>
            <h6>{{$todo->complete}}</h6>
        </div>
        @endforeach
    </body>
</html>
