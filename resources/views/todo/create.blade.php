{{-- template.blade.phpの@yield('logo-path')に渡す --}}
@section('logo-path', '../image/mytodo_icon.png')
{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'ToDo作成')
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
      <a class="dropdown-item" href="/user/profile">プロフィール</a>
      <a class="dropdown-item" href="/user/logout">ログアウト</a>
    </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      フォルダ
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="/folder/create_form">新規作成</a>
      <a class="dropdown-item" href="/folder/index/0">未設定</a>
      @if($folders)
        @foreach($folders as $folder)
          <a class="dropdown-item" href="/folder/index/{{ $folder->id }}">{{ $folder->name }}</a>
        @endforeach
      @endif
    </div>
  </li>
@endsection

{{-- template.blade.phpの@yield('content')に渡す --}}
@section('content')
  <div id="wrapper" class="pt-3 col-12 col-sm-12 col-md-12 col-lg-10 col-xl-8">
    <h2 class="pb-3">ToDo作成</h2>

    {{-- createアクションにフォームのデータをPOSTする --}}
    <form method="POST" action="/todo/create">
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
        <label for="explanationInput">詳細 <span class="badge badge-info">任意</span></label>
        <textarea class="form-control" id="explanationInput" name="explanation" cols="30" rows="10">{{old('explanation')}}</textarea>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-8 col-md-6 col-xl-4">
            {{-- old関数に値がある場合はそれを、ない場合は1をvalueに設定する --}}
            @if(old('difficulty'))
              <label for="difficultyInput">難易度</label>
              <input type="range" class="form-control-range" id="difficultyInput" name="difficulty" min="1" max="3" value="{{old('difficulty')}}">
            @else
              <label for="difficultyInput">難易度</label>
              <input type="range" class="form-control-range" id="difficultyInput" name="difficulty" min="1" max="3" value="1">
            @endif
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-8 col-md-6 col-xl-4">
            {{-- old関数に値がある場合はそれを、ない場合は1をvalueに設定する --}}
            @if(old('importance'))
            <label for="importanceInput">重要度</label>
              <input type="range" class="form-control-range" id="importanceInput" name="importance" min="1" max="3" value="{{old('importance')}}">
            @else
              <label for="importanceInput">重要度</label>
              <input type="range" class="form-control-range" id="importanceInput" name="importance" min="1" max="3" value="1">
            @endif
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-8 col-md-6 col-xl-4">
            {{-- old関数に値がある場合はそれを、ない場合は現在時刻をvalueに設定する --}}
            @if(old('deadline'))
              <label for="deadlineInput">目標期限 <span class="badge badge-danger">必須</span></label>
              <input type="date" class="form-control" id="deadlineInput" name="deadline" value="{{old('deadline')}}" required>
            @else
              <label for="deadlineInput">目標期限 <span class="badge badge-danger">必須</span></label>
              <input type="date" class="form-control" id="deadlineInput" name="deadline" value="{{date("Y-m-d")}}" required>
            @endif
          </div>
          <div class="col-sm-4 col-md-3 col-xl-2">
            <label for="deadline_timeInput">時刻 <span class="badge badge-info">任意</span></label>
            <input type="time" class="form-control" id="deadline_timeInput" name="deadline_time" value="{{old('deadline_time')}}">
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-8 col-md-6 col-xl-4">
            <label for="folderSelect">フォルダ <span class="badge badge-info">任意</span></label>
            <select class="form-control" name="folder_id" id="folderSelect">
              <option value="0">無し</option>
              @foreach($folders as $folder)
                <option value="{{ $folder->id }}">{{ $folder->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      {{-- 各種ボタン --}}
      <input type="submit" class="btn btn-success" value="追加">
      <a href="/" class="btn btn-primary">一覧に戻る</a>
    </form>
  </div>
@endsection
