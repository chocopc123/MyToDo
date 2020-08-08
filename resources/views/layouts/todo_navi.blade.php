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