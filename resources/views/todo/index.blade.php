{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', '未達成|MyToDo')
{{-- head.blade.phpを差し込む --}}
@include('layouts.head')

{{-- ヘッダー --}}
{{-- template.blade.phpの@yield('navi')に渡す --}}
{{-- class="active"と<span class="sr-only">(current)</span>を指定する --}}
@section('navi')
  <li class="nav-item active">
    <a class="nav-link" href="/">未達成リスト <span class="sr-only">(current)</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/index_completed">達成リスト</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      ダッシュボード
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="/profile">プロフィール</a>
      <a class="dropdown-item" href="/logout">ログアウト</a>
    </div>
  </li>
@endsection

{{-- template.blade.phpの@yield('content')に渡す --}}
@section('content')
  {{-- ToDo追加ボタン --}}
  <p class="pt-3"><a href="/create" class="btn btn-primary">ToDo追加</a></p>

  {{-- ToDoが一つもない場合はエラーを表示 --}}
  @if(count($todos)==0)
    <h5>ToDoがまだありません。</h5>
  @else
    {{-- 未達成のToDoを表示 --}}
    @foreach($todos as $todo)
      <div class="card mb-2">
        <div class="card-body">
          <h4 class="card-title">{{$todo->title}}</h4>
          <p>{!! nl2br(e($todo->explanation)) !!}</p>
          <h6 card-subtitle mb-2 text-muted>難易度：{{$todo->difficulty}}</h6>
          <h6 card-subtitle mb-2 text-muted>重要度：{{$todo->importance}}</h6>

          {{-- 目標期限に時間を設定している場合は表示する(時間設定は任意) --}}
          @if($todo->deadline_time)
            <h6 card-subtitle mb-2 text-muted>目標期限：{{$todo->deadline. " ". substr($todo->deadline_time, 0, 5)}}</h6>
          @else
            <h6 card-subtitle mb-2 text-muted>目標期限：{{$todo->deadline}}</h6>
          @endif

          <h6 card-subtitle mb-2 text-muted>作成日時：{{($todo->created_at)->format('Y-m-d H:i')}}</h6>

          {{-- 各種ボタン --}}
          <p><a href="/complete_confirm/{{$todo->id}}" class="btn btn-success">達成</a></p>
          <a href="/edit/{{$todo->id}}" class="card-link">修正</a>
          <a href="/delete_confirm/{{$todo->id}}" class="card-link">削除</a>
        </div>
      </div>
    @endforeach
    {{ $todos->links() }}
  @endif
@endsection
