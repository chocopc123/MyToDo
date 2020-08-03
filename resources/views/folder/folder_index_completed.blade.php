@section('sidebar')
  <ul class="list-group">
    <h4 class="pt-4 pb-2 pl-5 font-weight-bold">達成状況</h4>
    <a href="/folder_index/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold">未達成</a>
    <a href="/folder_index_completed/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold active">達成済み</a>
  </ul>
  <ul class="list-group">
    <h4 class="pt-4 pb-2 pl-5 font-weight-bold">絞り込み</h4>
    <a href="/folder_index_all/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('refine')=='/'){ echo "active"; } ?>">一覧</a>
    <a href="/folder_index_overdue/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('refine')=='/overdue'){ echo "active"; } ?>">期限超過</a>
  </ul>
  <ul class="list-group">
    <h4 class="pt-4 pb-2 pl-5 font-weight-bold">並べ変え</h4>
    <a href="/folder_index_created_at/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='created_at'){ echo "active"; } ?>">作成日時</a>
    <a href="/folder_index_deadline/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='deadline'){ echo "active"; } ?>">期限</a>
    <a href="/folder_index_difficulty/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='difficulty'){ echo "active"; } ?>">難易度</a>
    <a href="/folder_index_importance/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='importance'){ echo "active"; } ?>">重要度</a>
    <a href="/folder_index_completed_date/{{ $fold->id }}" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='completed_date'){ echo "active"; } ?>">達成日時</a>
  </ul>
@endsection
@extends('layouts.folder_index_template')