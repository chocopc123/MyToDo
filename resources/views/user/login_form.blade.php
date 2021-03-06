{{-- template.blade.phpの@yield('logo-path')に渡す --}}
@section('logo-path', '../image/mytodo_icon.png')
{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'ログイン')
{{-- head.blade.phpを差し込む --}}
@include('layouts.head')

{{-- ヘッダー --}}
{{-- template.blade.phpの@yield('navi')に渡す --}}
{{-- class="active"と<span class="sr-only">(current)</span>を指定する --}}
@section('navi')
  <li class="nav-item">
    <a class="nav-link" href="/user/register">新規登録</a>
  </li>
  <li class="nav-item active">
    <a class="nav-link" href="/user/login">ログイン <span class="sr-only">(current)</span></a>
  </li>
@endsection

{{-- template.blade.phpの@yield('content')に渡す --}}
@section('content')
  <div id="wrapper" class="pt-3 col-12 col-sm-12 col-md-8 col-xl-8">
    {{-- createアクションにフォームのデータをPOSTする --}}
    <form method="POST" action="/user/login">
      {{-- クロス・サイト・リクエスト・フォージェリ対策 --}}
      {{ csrf_field() }}

      {{-- バリデーションエラーがある場合は出力 --}}
      @if ($errors->any() || isset($auth_error))
        <div class="alert alert-danger">
          <ul>
            {{-- ログインエラーがある場合は出力 --}}
            @if(isset($auth_error))
              <li>{{ $auth_error }}</li>
            @endif
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- 各種フォーム入力欄 --}}
      {{-- バリデーションエラーがあった場合は、old関数で入力データを復元する --}}
      <div class="form-group">
        <label for="emailInput">メールアドレス</label>
        <input type="email" class="form-control" id="emailInput" name="email" value="{{old('email')}}" required>
      </div>
      <div class="form-group">
        <label for="passwordInput">パスワード</label>
        <input type="password" class="form-control" id="passwordInput" name="password" value="{{old('password')}}" required>
      </div>
      <div class="form-grout">
        <input type="checkbox" id="rememberInput" name="remember" value="true">
        <label for="rememberInput">ログイン状態を保持</label>
      </div>

      {{-- 各種ボタン --}}
      <input type="submit" class="btn btn-success" value="ログイン">
    </form>
  </div>
@endsection
