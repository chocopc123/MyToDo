{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', '達成済み|MyToDo')
{{-- head.blade.phpを差し込む --}}
@include('layouts.head')

{{-- ヘッダー --}}
{{-- template.blade.phpの@yield('navi')に渡す --}}
{{-- class="active"と<span class="sr-only">(current)</span>を指定する --}}
@section('navi')
  <li class="nav-item">
    <a class="nav-link" href="/">未達成リスト</a>
  </li>
  <li class="nav-item active">
    <a class="nav-link" href="/index_completed">達成リスト <span class="sr-only">(current)</span></a>
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
  <div id="wrapper" class="pt-3 col-12 col-sm-12 col-md-9 col-xl-10">
    {{-- ToDoが一つもない場合はエラーを表示 --}}
    @if(count($todos)==0)
      <h5>ToDoがまだありません。</h5>
    @else
      {{-- 達成済みのToDoを表示 --}}
      @foreach($todos as $todo)
        <div class="card mb-2">
          <div class="card-body">
            <h4 class="card-title">{{$todo->title}}</h4>
            <p>{!! nl2br(e($todo->explanation)) !!}</p>
            <h6 class="card-subtitle mb-2 text-body">難易度：{{$todo->difficulty}}</h6>
            <h6 class="card-subtitle mb-2 text-body">重要度：{{$todo->importance}}</h6>

            {{-- 現在日時と目標日時の差によってテキストカラーを変更 --}}
            <?php
              if( ($todo->deadline. " ". $todo->deadline_time) < ($todo->completed_date. " ". $todo->completed_time) ){
                echo '<h6 class="card-subtitle mb-2 text-danger">'. ((strtotime($todo->completed_date) - (strtotime($todo->deadline))) / (60*60*24)). "日遅延</h6>";
              }
            ?>
            {{-- 目標期限に時間を設定している場合は表示する(時間設定は任意) --}}
            @if($todo->deadline_time)
              <h6 class="card-subtitle mb-2 text-body">目標期限：{{$todo->deadline. " ". substr($todo->deadline_time, 0, 5)}}</h6>
            @else
              <h6 class="card-subtitle mb-2 text-body">目標期限：{{$todo->deadline}}</h6>
            @endif

            <h6 class="card-subtitle mb-2 text-body">作成日時：{{($todo->created_at)->format('Y-m-d H:i')}}</h6>
            <h6 class="card-subtitle mb-2 text-body">達成日時：{{$todo->completed_date. " ". substr($todo->completed_time, 0, 5)}}</h6>

            {{-- 各種ボタン --}}
            <p><a href="/release_confirm/{{$todo->id}}" class="btn btn-warning">解除</a></p>
            <a href="/edit/{{$todo->id}}" class="card-link">修正</a>
            <a href="/delete_confirm/{{$todo->id}}" class="card-link">削除</a>
          </div>
        </div>
      @endforeach
    @endif
  </div>

  {{-- サイドバー --}}
  <div class="col-12 col-sm-12 col-md-3 col-xl-2 order-md-first" style="background-color: #e3f2fd;">
    <ul class="list-group mt-3">
      <a href="/index_completed" class="list-group-item list-group-item-action font-weight-bold  <?php if(session('redirect')=='/index_completed'){ echo "active"; } ?>">達成済み一覧 <span class="sr-only">(current)</span></a>
    </ul>
  </div>
@endsection
