{{-- template.blade.phpの@yield('logo-path')に渡す --}}
@section('logo-path', 'image/mytodo_icon.png')
{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', '達成済み')
{{-- head.blade.phpを差し込む --}}
@include('layouts.head')

{{-- ナビゲーションバー --}}
@include('layouts.index.navi')

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

            {{-- 現在日時と達成日時の差によってテキストカラーを変更 --}}
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
            <p><a href="/todo/release_confirm/{{$todo->id}}" class="btn btn-warning">解除</a></p>
            <a href="/todo/edit/{{$todo->id}}" class="card-link">修正</a>
            <a href="/todo/delete_confirm/{{$todo->id}}" class="card-link">削除</a>
          </div>
        </div>
      @endforeach
      {{ $todos->links() }}
    @endif
  </div>

  {{-- サイドバー --}}
  @include('layouts.index.sidebar')
@endsection
