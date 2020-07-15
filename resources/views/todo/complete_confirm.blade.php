{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'ToDo達成確認|MyToDo')
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
  <li class="nav-item">
    <a class="nav-link" href="/login">ログイン</a>
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
  <h2>ToDo達成確認</h2>
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
    </div>
  </div>

  {{-- 連絡文 --}}
  <p>達成済みのToDoは達成リストに移動されます。</p>

  {{-- 達成ボタン --}}
  <div style="display:inline-flex">
    <form method="POST" action="/complete">
      {{-- クロス・サイト・リクエスト・フォージェリ対策 --}}
      {{ csrf_field() }}

      {{-- hiddenでidをコントローラに送る --}}
      <input type="hidden" name="id" value="{{$todo->id}}">
      <input type="submit" class="btn btn-primary" value="達成">
    </form>
  </div>

  {{-- 戻るボタン --}}
  <a href="/" class="btn btn-primary">一覧に戻る</a>
@endsection
