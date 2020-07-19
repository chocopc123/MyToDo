{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'ToDo編集')
{{-- head.blade.phpを差し込む --}}
@include('layouts.head')

{{-- ヘッダー --}}
{{-- template.blade.phpの@yield('navi')に渡す --}}
{{-- class="active"と<span class="sr-only">(current)</span>を指定する --}}
@section('navi')
  {{-- セッションの値によってactiveを付け替える --}}
  @if(session('completed'))
    <li class="nav-item">
      <a class="nav-link" href="/">未達成リスト</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="/index_completed">達成リスト <span class="sr-only">(current)</span></a>
    </li>
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
@endsection

{{-- template.blade.phpの@yield('content')に渡す --}}
@section('content')
  <div id="wrapper" class="pt-3 col-12 col-sm-12 col-md-8 col-xl-8">
    <h2 class="pb-3">ToDoの編集</h2>

    {{-- editアクションにフォームのデータをPOSTする --}}
    <form method="POST" action="/edit">
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
      {{-- hiddenでidをコントローラに送る --}}
      <input type="hidden" class="form-control" name="id" value="{{$todo->id}}">
      <div class="form-group">
        <label for="titleInput">タイトル <span class="badge badge-danger">必須</span></label>
        {{-- old関数に値がある場合はそれを、ない場合は元の内容をvalueに設定する --}}
        @if(old('title'))
          <input type="text" class="form-control" id="titleInput" name="title" value="{{old('title')}}" required>
        @else
          <input type="text" class="form-control" id="titleInput" name="title" value="{{$todo->title}}" required>
        @endif
      </div>
      <div class="form-group">
        <label for="explanationInput">詳細 <span class="badge badge-danger">必須</span></label>
        {{-- old関数に値がある場合はそれを、ない場合は元の内容をvalueに設定する --}}
        @if(old('explanation'))
          <textarea class="form-control" id="explanationInput" name="explanation" cols="30" rows="10" required>{{old('explanation')}}</textarea>
        @else
          <textarea class="form-control" id="explanationInput" name="explanation" cols="30" rows="10" required>{{$todo->explanation}}</textarea>
        @endif
      </div>
      <div class="form-group">
        {{-- old関数に値がある場合はそれを、ない場合は元の内容をvalueに設定する --}}
        @if(old('difficulty'))
          <label>難易度<input type="range" class="form-control-range" name="difficulty" min="1" max="3" value="{{old('difficulty')}}"></label>
        @else
          <label>難易度<input type="range" class="form-control-range" name="difficulty" min="1" max="3" value="{{$todo->difficulty}}"></label>
        @endif
      </div>
      <div class="form-group">
        {{-- old関数に値がある場合はそれを、ない場合は元の内容をvalueに設定する --}}
        @if(old('importance'))
          <label>重要度<input type="range" class="form-control-range" name="importance" min="1" max="3" value="{{old('importance')}}"></label>
        @else
          <label>重要度<input type="range" class="form-control-range" name="importance" min="1" max="3" value="{{$todo->importance}}"></label>
        @endif
      </div>
      <div class="form-group">
        {{-- old関数に値がある場合はそれを、ない場合は元の内容をvalueに設定する --}}
        @if(old('deadline'))
          <label>目標期限 <span class="badge badge-danger">必須</span><input type="date" class="form-control" name="deadline" value="{{old('deadline')}}" required></label>
        @else
          <label>目標期限 <span class="badge badge-danger">必須</span><input type="date" class="form-control" name="deadline" value="{{$todo->deadline}}" required></label>
        @endif
        {{-- old関数に値がある場合はそれを、ない場合は元の内容をvalueに設定する --}}
        @if(old('deadline_time'))
          <label>時刻 <span class="badge badge-info">任意</span><input type="time" class="form-control" name="deadline_time" value="{{old('deadline_time')}}"></label>
        @else
          <label>時刻 <span class="badge badge-info">任意</span><input type="time" class="form-control" name="deadline_time" value="{{$todo->deadline_time}}"></label>
        @endif
      </div>

      {{-- 達成済みだったら達成日付・時刻の編集フォームを表示 --}}
      @if($todo->complete)
        <div class="form-group">
          @if(old('completed_date'))
            <label>達成日付 <span class="badge badge-danger">必須</span><input type="date" class="form-control" name="completed_date" value="{{old('completed_date')}}" required></label>
          @else
            <label>達成日付 <span class="badge badge-danger">必須</span><input type="date" class="form-control" name="completed_date" value="{{$todo->completed_date}}" required></label>
          @endif
          @if(old('completed_time'))
            <label>時刻 <span class="badge badge-danger">必須</span><input type="time" class="form-control" name="completed_time" value="{{substr(old('completed_time'), 0, 5)}}" required></label>
          @else
            <label>時刻 <span class="badge badge-danger">必須</span><input type="time" class="form-control" name="completed_time" value="{{substr($todo->completed_time, 0, 5)}}" required></label>
          @endif
        </div>
      @endif

      {{-- 各種ボタン --}}
      <input type="submit" class="btn btn-success" value="修正">
      {{-- セッションの値によって一覧に戻るボタンの挙動を変える --}}
      <a href="{{ session('redirect') }}" class="btn btn-primary">一覧に戻る</a>
    </form>
  </div>
@endsection
