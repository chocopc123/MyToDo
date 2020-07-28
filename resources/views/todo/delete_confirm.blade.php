{{-- template.blade.phpの@yield('logo-path')に渡す --}}
@section('logo-path', '../image/mytodo_icon.png')
{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'ToDo削除')
{{-- head.blade.phpを差し込む --}}
@include('layouts.head')

{{-- ヘッダー --}}
{{-- template.blade.phpの@yield('navi')に渡す --}}
{{-- class="active"と<span class="sr-only">(current)</span>を指定する --}}
@section('navi')
  {{-- 達成リストのnavbar --}}
  @if(session('completed'))
    <li class="nav-item">
      <a class="nav-link" href="/">未達成リスト</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="/index_completed">達成リスト <span class="sr-only">(current)</span></a>
    </li>
  {{-- 未達成リストのnavbar --}}
  @else
    <li class="nav-item active">
      <a class="nav-link" href="/">未達成リスト <span class="sr-only">(current)</span>  </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/index_completed">達成リスト</a>
    </li>
  @endif
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
  <div id="wrapper" class="pt-3 col-12 col-sm-12 col-md-8 col-xl-8">
    <h2 class="pb-3">ToDo削除</h2>

    {{-- deleteアクションにフォームのデータをPOSTする --}}
    <form method="POST" action="/delete">
      {{-- クロス・サイト・リクエスト・フォージェリ対策 --}}
      {{ csrf_field() }}

      {{-- バリデーションエラーがある場合は出力 --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- hiddenでidをコントローラに送る --}}
      <input type="hidden" class="form-control" name="id" value="{{$todo->id}}">
      {{-- 各種値をフォームにreadonlyで表示 --}}
      <div class="form-group">
        <label for="titleInput">タイトル</label>
        <input type="text" readonly class="form-control" id="titleInput" name="title" value="{{$todo->title}}">
      </div>
      <div class="form-group">
        <label for="explanationInput">詳細</label>
        <textarea readonly class="form-control" id="explanationInput" name="explanation" cols="30" rows="10">{{$todo->explanation}}</textarea>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-8 col-md-6 col-xl-4">
            <label for="difficultyInput">難易度</label>
            <input type="range" readonly class="form-control-range" id="difficultyInput" name="difficulty" min="1" max="3" value="{{$todo->difficulty}}">
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-8 col-md-6 col-xl-4">
            <label for="importanceInput">重要度</label>
            <input type="range" readonly class="form-control-range" id="importanceInput name="importance" min="1" max="3" value="{{$todo->importance}}">
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-8 col-md-6 col-xl-4">
            <label for="deadlineInput">目標期限</label>
            <input type="date" readonly class="form-control" id="deadlineInput" name="deadline" value="{{$todo->deadline}}">
          </div>
          <div class="col-sm-4 col-md-3 col-xl-2">
            <label for="deadline_timeInput">時刻</label>
            <input type="time" readonly class="form-control" id="deadline_timeInput" name="deadline_time" value="{{$todo->deadline_time}}">
          </div>
      </div>
      @if($todo->complete)
        <div class="form-group pt-3">
          <div class="row">
            <div class="col-sm-8 col-md-6 col-xl-4">
              <label for="completed_dateInput">達成日付</label>
              <input type="date" readonly class="form-control" id="completed_dateInput" name="completed_date" value="{{$todo->completed_date}}">
            </div>
            <div class="col-sm-4 col-md-3 col-xl-2">
              <label for="completed_timeInput">時刻</label>
              <input type="time" readonly class="form-control" id="completed_timeInput" name="completed_time" value="{{substr($todo->completed_time, 0, 5)}}">
            </div>
          </div>
        </div>
      @endif
      <div class="form-group">
        <div class="row">
          <div class="col-sm-8 col-md-6 col-xl-4">
            <label for="folderSelect">フォルダ <span class="badge badge-info">任意</span></label>
            @foreach($folders as $folder)
              @if($folder->id == $todo->folder_id)
                <input type="text" readonly class="form-control" id="folderSelect" name="folder_id" value="{{ $folder->name }}">
              @endif
            @endforeach
        </div>
        </div>
      </div>

      {{-- 各種ボタン --}}
      <input type="submit" readonly class="btn btn-danger" value="削除">
      {{-- セッションの値によって一覧に戻るボタンの挙動を変える --}}
      <a href="{{ session('redirect') }}" class="btn btn-primary">一覧に戻る</a>
    </form>
  </div>
@endsection
