{{-- template.blade.phpの@yield('logo-path')に渡す --}}
@section('logo-path', '../image/mytodo_icon.png')
{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'プロフィール')
{{-- head.blade.phpを差し込む --}}
@include('layouts.head')

{{-- ナビゲーションバー --}}
@include('layouts.user.navi')

{{-- template.blade.phpの@yield('content')に渡す --}}
@section('content')
  <div id="wrapper" class="pt-3 col-12 col-sm-12 col-md-8 col-xl-8">
    <h3 class="pb-3">プロフィール</h3>

    <div>
      {{-- ユーザープロフィール表示 --}}
      <table>
        <tr>
          <th>ニックネーム</th>
          <td>{{ Auth::user()->name }}</td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td>{{ Auth::user()->email }}</td>
        </tr>
      </table>
      {{-- ユーザー削除ボタン --}}
      <p class="pt-3"><a href="/user/user_delete_confirm/{{ Auth::id() }}" class="btn btn-danger">ユーザー削除</a></p>
    </div>
  </div>
@endsection
