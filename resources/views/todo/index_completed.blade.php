{{-- template.blade.phpの@yield('logo-path')に渡す --}}
@section('logo-path', 'image/mytodo_icon.png')
{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', '達成済み')
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
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      フォルダ
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="/folder_create_form">新規作成</a>
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
  <div id="wrapper" class="pt-3 col-12 col-sm-12 col-md-9 col-xl-10">
    {{-- 件数表示 --}}
    <a class="text-muted">{{ $todos->total() }} 件</a>
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
              if( (($todo->deadline. " ". $todo->deadline_time) < ($todo->completed_date. " ". $todo->completed_time) && $todo->deadline_time != null) || $todo->deadline < $todo->completed_date & $todo->deadline_time == null ){
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
            {{-- フォルダ名を表示 --}}
            @foreach($folders as $folder)
              @if($folder->id == $todo->folder_id)
                <h6 class="card-subtitle mb-2 text-body">フォルダ名：{{ $folder->name }}</h6>
              @endif
            @endforeach

            {{-- 各種ボタン --}}
            <p><a href="/release_confirm/{{$todo->id}}" class="btn btn-warning">解除</a></p>
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
    <ul class="list-group">
      <h4 class="pt-4 pb-2 pl-5 font-weight-bold">絞り込み</h4>
      <a href="/index_all" class="list-group-item list-group-item-action font-weight-bold  <?php if(session('refine')=='/'){ echo "active"; } ?>">達成済み一覧 <span class="sr-only">(current)</span></a>
      <a href="/overdue" class="list-group-item list-group-item-action font-weight-bold <?php if(session('refine')=='/overdue'){ echo "active"; } ?>">期限超過</a>
    </ul>
    <ul class="list-group">
      <h4 class="pt-4 pb-2 pl-5 font-weight-bold">並べ変え</h4>
      <a href="/index_created_at" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='created_at'){ echo "active"; } ?>">作成日時</a>
      <a href="/index_deadline" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='deadline'){ echo "active"; } ?>">期限</a>
      <a href="/index_difficulty" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='difficulty'){ echo "active"; } ?>">難易度</a>
      <a href="/index_importance" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='importance'){ echo "active"; } ?>">重要度</a>
      <a href="/index_completed_date" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='completed_date'){ echo "active"; } ?>">達成日時</a>
    </ul>
  </div>
@endsection
