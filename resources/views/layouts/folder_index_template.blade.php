{{-- template.blade.phpの@yield('logo-path')に渡す --}}
@section('logo-path', '../image/mytodo_icon.png')
{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'フォルダ詳細')
{{-- head.blade.phpを差し込む --}}
@include('layouts.head')

{{-- ヘッダー --}}
{{-- template.blade.phpの@yield('navi')に渡す --}}
{{-- class="active"と<span class="sr-only">(current)</span>を指定する --}}
@section('navi')
  <li class="nav-item">
    <a class="nav-link" href="/">未達成リスト</a>
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
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      フォルダ <span class="sr-only">(current)</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="/folder_create_form">新規作成</a>
      <a class="dropdown-item" href="/folder_index/0">未設定</a>
      @if($folders)
        @foreach($folders as $folder)
          <a class="dropdown-item" href="/folder_index/{{ $folder->id }}">{{ $folder->name }}</a>
        @endforeach
      @endif
    </div>
  </li>
@endsection

{{-- template.blade.phpの@yield('content')に渡す --}}
@section('content')
  <div id="wrapper" class="col-12 col-sm-12 col-md-9 col-xl-10">
    {{-- フォルダ名表示 --}}
    <h3 class="pt-3">{{ $fold->name }}</h3>
    <div class="py-3">
      @if($fold->id != 0)
        {{-- フォルダへToDo追加ボタン --}}
        <a href="/add_folder_form/{{ $fold->id }}" class="btn btn-primary">フォルダへ追加</></a>
        {{-- フォルダ削除ボタン --}}
        <a href="/delete_folder_confirm/{{ $fold->id }}" class="btn btn-danger">フォルダを削除</></a>
      @endif
      {{-- 検索ワードと結果件数表示 --}}
      @if($search)
        <a class="pl-2 text-muted">検索ワード：{{ $search }}</a>
      @endif
      {{-- 件数表示 --}}
      <a class="pl-2 text-muted">{{ $todos->total() }} 件</a>
    </div>
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
            <h6 class="card-subtitle mb-2 text-body">難易度：{{$todo->difficulty}}</h6>
            <h6 class="card-subtitle mb-2 text-body">重要度：{{$todo->importance}}</h6>

            {{-- 現在日時と目標日時の差によって期限までの日数を表示 --}}
            <?php
              if($todo->deadline == date("Y-m-d")):
                echo '<h6 class="card-subtitle mb-2 text-danger">本日期限</h6>';
              elseif( ($todo->deadline. " ". $todo->deadline_time) < date("Y-m-d H:i:s") ):
                echo '<h6 class="card-subtitle mb-2 text-danger">'. ((strtotime(date("Y-m-d")) - (strtotime($todo->deadline))) / (60*60*24)). "日経過</h6>";
              elseif( ($todo->deadline) < date("Y-m-d", strtotime('+4 day')) ):
                echo '<h6 class="card-subtitle mb-2 text-warning">あと'. (strtotime($todo->deadline) - strtotime(date("Y-m-d"))) / (60*60*24). "日</h6>";
              else:
                echo '<h6 class="card-subtitle mb-2 text-success">あと'. (strtotime($todo->deadline) - strtotime(date("Y-m-d"))) / (60*60*24). "日</h6>";
              endif;
            ?>
            {{-- 目標期限に時間を設定している場合は表示する(時間設定は任意) --}}
            @if($todo->deadline_time)
              <h6 class="card-subtitle mb-2 text-body">目標期限：{{$todo->deadline. " ". substr($todo->deadline_time, 0, 5)}}</h6>
            @else
              <h6 class="card-subtitle mb-2 text-body">目標期限：{{$todo->deadline}}</h6>
            @endif

            <h6 class="card-subtitle mb-2 text-body">作成日時：{{($todo->created_at)->format('Y-m-d H:i')}}</h6>
            @if($todo->completed_date)
              <h6 class="card-subtitle mb-2 text-body">達成日時：{{$todo->completed_date. " ". substr($todo->completed_time, 0, 5)}}</h6>
            @endif

            {{-- 各種ボタン --}}
            <p>
              <a href="/complete_confirm/{{$todo->id}}" class="btn btn-success">達成</a>
              <a href="/folder_release_confirm/{{$fold->id}}/{{$todo->id}}" class="btn btn-danger">フォルダから削除</a>
            </p>
            <a href="/edit/{{$todo->id}}" class="card-link">修正</a>
            <a href="/delete_confirm/{{$todo->id}}" class="card-link">削除</a>
          </div>
        </div>
      @endforeach
      {{ $todos->links() }}
    @endif
  </div>

  {{-- サイドバー --}}
  <div class="col-12 col-sm-12 col-md-3 col-xl-2 order-md-first" style="background-color: #e3f2fd;">
    @yield('sidebar')
  </div>
@endsection