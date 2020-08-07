@section('sidebar')
  <ul class="list-group">
    <h4 class="pt-4 pb-2 pl-5 font-weight-bold">達成状況</h4>
    <a href="/folder/add_form/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold">未達成</a>
    <a href="/folder/add_completed_form/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold active">達成済み</a>
  </ul>
  <ul class="list-group">
    <h4 class="pt-4 pb-2 pl-5 font-weight-bold">絞り込み</h4>
    <a href="/folder/add_all/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('refine')=='/'){ echo "active"; } ?>">一覧</a>
    <a href="/folder/add_overdue/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('refine')=='/overdue'){ echo "active"; } ?>">期限超過</a>
  </ul>
  <ul class="list-group">
    <h4 class="pt-4 pb-2 pl-5 font-weight-bold">並べ替え</h4>
    <a href="/folder/add_created_at/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='created_at'){ echo "active"; } ?>">作成日時 <?php if(session('sort')=='created_at'){ echo '[' . session('order') . ']'; } ?></a>
    <a href="/folder/add_deadline/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='deadline'){ echo "active"; } ?>">期限 <?php if(session('sort')=='deadline'){ echo '[' . session('order') . ']'; } ?></a>
    <a href="/folder/add_difficulty/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='difficulty'){ echo "active"; } ?>">難易度 <?php if(session('sort')=='difficulty'){ echo '[' . session('order') . ']'; } ?></a>
    <a href="/folder/add_importance/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='importance'){ echo "active"; } ?>">重要度 <?php if(session('sort')=='importance'){ echo '[' . session('order') . ']'; } ?></a>
  </ul>
@endsection
@extends('layouts.add_folder_form_template')
