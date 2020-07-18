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
  <li class="nav-item active">
    <a class="nav-link" href="/register">新規登録 <span class="sr-only">(current)</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/login">ログイン</a>
  </li>
@endsection

{{-- template.blade.phpの@yield('content')に渡す --}}
@section('content')
  <div id="wrapper" class="pt-3 col-12 col-sm-12 col-md-8 col-xl-8">
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
        <input type="password" class="form-control" id="passwordInput" name="password" required>
        <span class="form-text text-muted">パスワードは8文字以上128文字以内で入力してください。</span>
      </div>
      <div class="form-group">
        <label for="passwordInput">パスワード確認 <span class="badge badge-danger">必須</span></label>
        <input type="password" class="form-control" id="passwordInput" name="password_confirmation" required>
      </div>

      {{-- 各種ボタン --}}
      <input type="submit" class="btn btn-success" value="登録">
    </form>
  </div>
@endsection
