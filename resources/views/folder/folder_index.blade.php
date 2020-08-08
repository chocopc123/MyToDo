@section('sidebar')
  <ul class="list-group">
    <h4 class="pt-4 pb-2 pl-5 font-weight-bold">達成状況</h4>
    <a href="/folder/index/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold active">未達成</a>
    <a href="/folder/index_completed/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold">達成済み</a>
  </ul>
  <ul class="list-group">
    <h4 class="pt-4 pb-2 pl-5 font-weight-bold">絞り込み</h4>
    <a href="/folder/refine/all/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('refine')=='/'){ echo "active"; } ?>">一覧</a>
    <a href="/folder/refine/duesoon/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('refine')=='/duesoon'){ echo "active"; } ?>">期限間近</a>
    <a href="/folder/refine/overdue/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('refine')=='/overdue'){ echo "active"; } ?>">期限超過</a>
  </ul>
  <ul class="list-group">
    <h4 class="pt-4 pb-2 pl-5 font-weight-bold">並べ替え</h4>
    <a href="/folder/sort/created_at/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='created_at'){ echo "active"; } ?>">作成日時 <?php if(session('sort')=='created_at'){ echo '[' . session('order') . ']'; } ?></a>
    <a href="/folder/sort/deadline/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='deadline'){ echo "active"; } ?>">期限 <?php if(session('sort')=='deadline'){ echo '[' . session('order') . ']'; } ?></a>
    <a href="/folder/sort/difficulty/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='difficulty'){ echo "active"; } ?>">難易度 <?php if(session('sort')=='difficulty'){ echo '[' . session('order') . ']'; } ?></a>
    <a href="/folder/sort/importance/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='importance'){ echo "active"; } ?>">重要度 <?php if(session('sort')=='importance'){ echo '[' . session('order') . ']'; } ?></a>
  </ul>
@endsection
@extends('layouts.folder.index_template')