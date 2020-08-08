{{-- template.blade.phpの@yield('logo-path')に渡す --}}
@section('logo-path', '../../image/mytodo_icon.png')
{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'ユーザー削除')
{{-- head.blade.phpを差し込む --}}
@include('layouts.head')

{{-- ナビゲーションバー --}}
@include('layouts.user.navi')

{{-- template.blade.phpの@yield('content')に渡す --}}
@section('content')
  <div id="wrapper" class="pt-3 col-12 col-sm-12 col-md-8 col-xl-8">
    <h2 class="pb-3">ユーザー削除</h2>
    <p>本当に削除していいですか?</p>
    {{-- deleteアクションにフォームのデータをPOSTする --}}
    <form method="POST" action="/user/user_delete">
      {{-- クロス・サイト・リクエスト・フォージェリ対策 --}}
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$user->id}}">
      {{-- 各種ボタン --}}
      <input type="submit" readonly class="btn btn-danger" value="削除">
      {{-- セッションの値によって一覧に戻るボタンの挙動を変える --}}
      <a href="/user/profile" class="btn btn-primary">戻る</a>
    </form>
  </div>
@endsection
