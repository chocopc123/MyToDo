{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'ユーザー作成|MyToDo')
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
  {{-- createアクションにフォームのデータをPOSTする --}}
  <form method="POST" action="/register">
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
      <label for="nameInput">ニックネーム <span class="badge badge-danger">必須</span></label>
      <input type="text" class="form-control" id="nameInput" name="name" value="{{old('name')}}" required>
    </div>
    <div class="form-group">
      <label for="emailInput">メールアドレス <span class="badge badge-danger">必須</span></label>
      <input type="email" class="form-control" id="emailInput" name="email" value="{{old('email')}}" required>
    </div>
    <div class="form-group">
      <label for="passwordInput">パスワード <span class="badge badge-danger">必須</span></label>
      <input type="password" class="form-control" id="passwordInput" name="password" value="{{old('password')}}" required>
    </div>
    <div class="form-group">
      <label for="passwordInput">パスワード確認 <span class="badge badge-danger">必須</span></label>
      <input type="password" class="form-control" id="passwordInput" name="password_confirmation" value="{{old('password')}}" required>
    </div>

    {{-- 各種ボタン --}}
    <input type="submit" class="btn btn-success" value="登録">
  </form>
@endsection
