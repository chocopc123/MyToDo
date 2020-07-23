{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'ユーザー作成')
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
    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      ダッシュボード <span class="sr-only">(current)</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item active" href="/profile">プロフィール <span class="sr-only">(current)</span></a>
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
          <a class="dropdown-item" href="#">{{ $folder->name }}</a>
        @endforeach
      @endif
    </div>
  </li>
@endsection

{{-- template.blade.phpの@yield('content')に渡す --}}
@section('content')
  <div id="wrapper" class="pt-3 col-12 col-sm-12 col-md-8 col-xl-8">
    {{-- createアクションにフォームのデータをPOSTする --}}
    <form method="POST" action="/folder_create">
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
        <label for="nameInput">フォルダ名 <span class="badge badge-danger">必須</span></label>
        <input type="text" class="form-control" id="nameInput" name="name" value="{{old('name')}}" required>
      </div>

      {{-- 各種ボタン --}}
      <input type="submit" class="btn btn-success" value="作成">
    </form>
  </div>
@endsection
