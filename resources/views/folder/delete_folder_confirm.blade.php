{{-- template.blade.phpの@yield('logo-path')に渡す --}}
@section('logo-path', '../image/mytodo_icon.png')
{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'フォルダ削除')
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
      ダッシュボード
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="/user/profile">プロフィール</a>
      <a class="dropdown-item" href="/user/logout">ログアウト</a>
    </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      フォルダ <span class="sr-only">(current)</span>
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
  <div id="wrapper" class="pt-3 col-12 col-sm-12 col-md-8 col-xl-8">
    <h2 class="pb-3">{{ $fold->name }}</h2>

    {{-- delete_folderアクションにフォームのデータをPOSTする --}}
    <form method="POST" action="/folder/delete">
      {{-- クロス・サイト・リクエスト・フォージェリ対策 --}}
      {{ csrf_field() }}

      {{-- hiddenでidをコントローラに送る --}}
      <input type="hidden" class="form-control" name="id" value="{{$fold->id}}">

      {{-- 各種ボタン --}}
      <input type="submit" readonly class="btn btn-danger" value="削除">
      {{-- セッションの値によって一覧に戻るボタンの挙動を変える --}}
      <a href="{{ session('redirect') }}" class="btn btn-primary">一覧に戻る</a>
    </form>
  </div>
@endsection
