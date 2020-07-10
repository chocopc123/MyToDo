<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <title>ToDo一覧|MyToDo</title>
    </head>
    <body>
        <h3>ToDo一覧</h3>
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
