{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'ToDo追加|MyToDo')
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
  <h2>ToDo追加</h2>

  {{-- createアクションにフォームのデータをPOSTする --}}
  <form method="POST" action="/create">
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

    {{-- 各種フォーム入力欄 --}}
    {{-- バリデーションエラーがあった場合は、old関数で入力データを復元する --}}
    <div class="form-group">
      <label for="titleInput">タイトル <span class="badge badge-danger">必須</span></label>
      <input type="text" class="form-control" id="titleInput" name="title" value="{{old('title')}}" required>
    </div>
    <div class="form-group">
      <label for="explanationInput">詳細 <span class="badge badge-danger">必須</span></label>
      <textarea class="form-control" id="explanationInput" name="explanation" cols="30" rows="10" required>{{old('explanation')}}</textarea>
    </div>
    <div class="form-group">
      {{-- old関数に値がある場合はそれを、ない場合は1をvalueに設定する --}}
      @if(old('difficulty'))
        <label>難易度<input type="range" class="form-control-range" name="difficulty" min="1" max="3" value="{{old('difficulty')}}"></label>
      @else
        <label>難易度<input type="range" class="form-control-range" name="difficulty" min="1" max="3" value="1"></label>
      @endif
    </div>
    <div class="form-group">
      {{-- old関数に値がある場合はそれを、ない場合は1をvalueに設定する --}}
      @if(old('importance'))
        <label>重要度<input type="range" class="form-control-range" name="importance" min="1" max="3" value="{{old('importance')}}"></label>
      @else
        <label>重要度<input type="range" class="form-control-range" name="importance" min="1" max="3" value="1"></label>
      @endif
    </div>
    <div class="form-group">
      {{-- old関数に値がある場合はそれを、ない場合は現在時刻をvalueに設定する --}}
      @if(old('deadline'))
        <label>目標期限 <span class="badge badge-danger">必須</span><input type="date" class="form-control" name="deadline" value="{{old('deadline')}}" required></label>
      @else
        <label>目標期限 <span class="badge badge-danger">必須</span><input type="date" class="form-control" name="deadline" value="{{date("Y-m-d")}}" required></label>
      @endif

      <label>時刻 <span class="badge badge-info">任意</span><input type="time" class="form-control" name="deadline_time" value="{{old('deadline_time')}}"></label>
    </div>

    {{-- 各種ボタン --}}
    <input type="submit" class="btn btn-success" value="追加">
    <a href="/" class="btn btn-primary">一覧に戻る</a>
  </form>
@endsection
