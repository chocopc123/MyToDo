{{-- template.blade.phpの@yield('logo-path')に渡す --}}
@section('logo-path', '../../image/mytodo_icon.png')
{{-- templateを読み込む --}}
@extends('layouts.template')

{{-- head.blade.phpの@yield('title')に渡す --}}
@section('title', 'ToDo編集')
{{-- head.blade.phpを差し込む --}}
@include('layouts.head')

{{-- ナビゲーションバー --}}
@include('layouts.index.navi')

{{-- template.blade.phpの@yield('content')に渡す --}}
@section('content')
  <div id="wrapper" class="pt-3 col-12 col-sm-12 col-md-8 col-xl-8">
    <h2 class="pb-3">ToDoの編集</h2>

    {{-- editアクションにフォームのデータをPOSTする --}}
    <form method="POST" action="/todo/edit">
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
      {{-- hiddenでidをコントローラに送る --}}
      <input type="hidden" class="form-control" name="id" value="{{$todo->id}}">
      <div class="form-group">
        <label for="titleInput">タイトル <span class="badge badge-danger">必須</span></label>
        {{-- old関数に値がある場合はそれを、ない場合は元の内容をvalueに設定する --}}
        @if(old('title'))
          <input type="text" class="form-control" id="titleInput" name="title" value="{{old('title')}}" required>
        @else
          <input type="text" class="form-control" id="titleInput" name="title" value="{{$todo->title}}" required>
        @endif
      </div>
      <div class="form-group">
        <label for="explanationInput">詳細 <span class="badge badge-info">任意</span></label>
        {{-- old関数に値がある場合はそれを、ない場合は元の内容をvalueに設定する --}}
        @if(old('explanation'))
          <textarea class="form-control" id="explanationInput" name="explanation" cols="30" rows="10">{{old('explanation')}}</textarea>
        @else
          <textarea class="form-control" id="explanationInput" name="explanation" cols="30" rows="10">{{$todo->explanation}}</textarea>
        @endif
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-8 col-md-6 col-xl-4">
            {{-- old関数に値がある場合はそれを、ない場合は元の内容をvalueに設定する --}}
            @if(old('difficulty'))
              <label for="difficultyInput">難易度</label>
              <input type="range" class="form-control-range" id="difficultyInput" name="difficulty" min="1" max="3" value="{{old('difficulty')}}">
            @else
              <label for="difficultyInput">難易度</label>
              <input type="range" class="form-control-range" name="difficulty" id="difficultyInput" min="1" max="3" value="{{$todo->difficulty}}">
            @endif
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-8 col-md-6 col-xl-4">
            {{-- old関数に値がある場合はそれを、ない場合は元の内容をvalueに設定する --}}
            @if(old('importance'))
              <label for="importanceInput">重要度</label>
              <input type="range" class="form-control-range" id="importanceInput" name="importance" min="1" max="3" value="{{old('importance')}}">
            @else
              <label for="importanceInput">重要度</label>
              <input type="range" class="form-control-range" id="importanceInput" name="importance" min="1" max="3" value="{{$todo->importance}}">
            @endif
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-8 col-md-6 col-xl-4">
            {{-- old関数に値がある場合はそれを、ない場合は元の内容をvalueに設定する --}}
            @if(old('deadline'))
              <label for="deadlineInput">目標期限 <span class="badge badge-danger">必須</span></label>
              <input type="date" class="form-control" id="deadlineInput" name="deadline" value="{{old('deadline')}}" required>
            @else
              <label for="deadlineInput">目標期限 <span class="badge badge-danger">必須</span></label>
              <input type="date" class="form-control" id="deadlineInput" name="deadline" value="{{$todo->deadline}}" required>
            @endif
          </div>

          <div class="col-sm-4 col-md-3 col-xl-2">
            {{-- old関数に値がある場合はそれを、ない場合は元の内容をvalueに設定する --}}
            @if(old('deadline_time'))
              <label for="deadline_timeInput">時刻 <span class="badge badge-info">任意</span></label>
              <input type="time" class="form-control" id="deadline_timeInput" name="deadline_time" value="{{old('deadline_time')}}">
            @else
              <label for="deadline_timeInput">時刻 <span class="badge badge-info">任意</span></label>
              <input type="time" class="form-control" id="deadline_timeInput" name="deadline_time" value="{{$todo->deadline_time}}">
            @endif
          </div>
        </div>
      </div>

      {{-- 達成済みだったら達成日付・時刻の編集フォームを表示 --}}
      @if($todo->complete)
        <div class="form-group">
          <div class="row">
            <div class="col-sm-8 col-md-6 col-xl-4">
              {{-- old関数に値がある場合はそれを、ない場合は元の値をvalueに設定する --}}
              @if(old('completed_date'))
                <label for="completed_dateInput">達成日付 <span class="badge badge-danger">必須</span></label>
                <input type="date" class="form-control" id="completed_dateInput" name="completed_date" value="{{old('completed_date')}}" required>
              @else
                <label for="completed_dateInput">達成日付 <span class="badge badge-danger">必須</span></label>
                <input type="date" class="form-control" id="completed_dateInput" name="completed_date" value="{{$todo->completed_date}}" required>
              @endif
            </div>
            <div class="col-sm-4 col-md-3 col-xl-2">
              {{-- old関数に値がある場合はそれを、ない場合は元の値をvalueに設定する --}}
              @if(old('completed_time'))
                <label for="completed_timeInput">時刻 <span class="badge badge-danger">必須</span></label>
                <input type="time" class="form-control" id="completed_timeInput" name="completed_time" value="{{substr(old('completed_time'), 0, 5)}}" required>
              @else
                <label for="completed_timeInput">時刻 <span class="badge badge-danger">必須</span></label>
                <input type="time" class="form-control" id="completed_timeInput" name="completed_time" value="{{substr($todo->completed_time, 0, 5)}}" required>
              @endif
            </div>
          </div>
        </div>
      @endif

      <div class="form-group">
        <div class="row">
          <div class="col-sm-8 col-md-6 col-xl-4">
            <label for="folderSelect">フォルダ <span class="badge badge-info">任意</span></label>
            <select class="form-control" name="folder_id" id="folderSelect">
              <option value="0">無し</option>
              @foreach($folders as $folder)
                @if($folder->id == $todo->folder_id)
                  <option value="{{ $folder->id }}" selected>{{ $folder->name }}</option>
                @else
                  <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>
      </div>

      {{-- 各種ボタン --}}
      <input type="submit" class="btn btn-success" value="修正">
      {{-- セッションの値によって一覧に戻るボタンの挙動を変える --}}
      <a href="{{ session('redirect') }}" class="btn btn-primary">一覧に戻る</a>
    </form>
  </div>
@endsection
