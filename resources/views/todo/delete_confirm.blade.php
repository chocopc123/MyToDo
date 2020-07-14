{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'ToDo削除|MyToDo')
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
      Dropdown
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Something else here</a>
    </div>
  </li>
@endsection

{{-- template.blade.phpの@yield('content')に渡す --}}
@section('content')
  <h2>ToDo削除</h2>

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

    {{-- 各種値をフォームにreadonlyで表示 --}}
    {{-- hiddenでidをコントローラに送る --}}
    <input type="hidden" class="form-control" name="id" value="{{$todo->id}}">
    <div class="form-group">
      <label for="titleInput">タイトル</label>
      <input type="text" readonly class="form-control" id="titleInput" name="title" value="{{$todo->title}}">
    </div>
    <div class="form-group">
      <label for="explanationInput">詳細</label>
      <textarea readonly class="form-control" id="explanationInput" name="explanation" cols="30" rows="10">{{$todo->explanation}}</textarea>
    </div>
    <div class="form-group">
      <label>難易度<input type="range" readonly class="form-control-range" name="difficulty" min="1" max="3" value="{{$todo->difficulty}}"></label>
    </div>
    <div class="form-group">
      <label>重要度<input type="range" readonly class="form-control-range" name="importance" min="1" max="3" value="{{$todo->importance}}"></label>
    </div>
    <div class="form-group">
      <label>目標期限<input type="date" readonly class="form-control" name="deadline" value="{{$todo->deadline}}"></label>
      <label>時刻<input type="time" readonly class="form-control" name="deadline_time" value="{{$todo->deadline_time}}"></label>
    </div>
    @if($todo->complete)
      <div class="form-group">
        <label>達成日付<input type="date" readonly class="form-control" name="completed_date" value="{{$todo->completed_date}}"></label>
        <label>時刻<input type="time" readonly class="form-control" name="completed_time" value="{{substr($todo->completed_time, 0, 5)}}"></label>
      </div>
    @endif

    {{-- 各種ボタン --}}
    <input type="submit" readonly class="btn btn-danger" value="削除"></li>
    @if(session('completed'))
      <a href="/index_completed" class="btn btn-primary">一覧に戻る</a>
    @else
      <a href="/" class="btn btn-primary">一覧に戻る</a>
    @endif
  </form>
@endsection
