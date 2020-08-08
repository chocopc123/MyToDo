{{-- template.blade.phpの@yield('logo-path')に渡す --}}
@section('logo-path', '../../image/mytodo_icon.png')
{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'ToDo達成解除')
{{-- head.blade.phpを差し込む --}}
@include('layouts.head')

{{-- ナビゲーションバー --}}
@include('layouts.todo_navi')

{{-- template.blade.phpの@yield('content')に渡す --}}
@section('content')
  <div id="wrapper" class="pt-3 col-12 col-sm-12 col-md-8 col-xl-8">
    <h2 class="pb-3">ToDo達成解除</h2>
    {{-- ToDoの内容表示 --}}
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
        <h6 card-subtitle mb-2 text-muted>達成日時：{{$todo->completed_date. " ". substr($todo->completed_time, 0, 5)}}</h6>
        {{-- フォルダ名を表示 --}}
        @foreach($folders as $folder)
          @if($folder->id == $todo->folder_id)
            <h6 class="card-subtitle mb-2 text-body">フォルダ名：{{ $folder->name }}</h6>
          @endif
        @endforeach
      </div>
    </div>

    {{-- 連絡文 --}}
    <p>解除されたToDoは未達成リストに移動されます。</p>

    {{-- 達成解除ボタン --}}
    <div style="display:inline-flex">
      <form method="POST" action="/todo/release">
        {{-- クロス・サイト・リクエスト・フォージェリ対策 --}}
        {{ csrf_field() }}

        {{-- hiddenでidをコントローラに送る --}}
        <input type="hidden" name="id" value="{{$todo->id}}">
        <input type="submit" class="btn btn-warning" value="解除">
      </form>
    </div>

    {{-- 戻るボタン --}}
    <a href="/index_completed" class="btn btn-primary">一覧に戻る</a>
  </div>
@endsection
