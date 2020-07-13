{{-- templete.blade.phpの@yield('head')に渡す --}}
@section('head')
    {{-- 文字エンコーディングの指定 --}}
    <meta charset="utf-8">

    {{-- レスポンシブWebデザイン設定 --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- bootstrap4の読み込み --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    {{-- index.blade.phpの@section('title', '表示したいタイトル')を受け取る --}}
    <title>@yield('title')</title>
@endsection