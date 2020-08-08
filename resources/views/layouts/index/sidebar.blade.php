{{-- サイドバー --}}
<div class="col-12 col-sm-12 col-md-3 col-xl-2 order-md-first" style="background-color: #e3f2fd;">
  <ul class="list-group">
    <h4 class="pt-4 pb-2 pl-5 font-weight-bold">絞り込み</h4>
    <a href="/index/refine/all" class="list-group-item list-group-item-action font-weight-bold <?php if(session('refine')=='/'){ echo "active"; } ?>">未達成一覧</a>
    <a href="/index/refine/duesoon" class="list-group-item list-group-item-action font-weight-bold <?php if(session('refine')=='/duesoon'){ echo "active"; } ?>">期限間近</a>
    <a href="/index/refine/overdue" class="list-group-item list-group-item-action font-weight-bold <?php if(session('refine')=='/overdue'){ echo "active"; } ?>">期限超過</a>
  </ul>
  <ul class="list-group">
    <h4 class="pt-4 pb-2 pl-5 font-weight-bold">並べ替え</h4>
    <a href="/index/sort/created_at" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='created_at'){ echo "active"; } ?>">作成日時 <?php if(session('sort')=='created_at'){ echo '[' . session('order') . ']'; } ?></a>
    <a href="/index/sort/deadline" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='deadline'){ echo "active"; } ?>">期限 <?php if(session('sort')=='deadline'){ echo '[' . session('order') . ']'; } ?></a>
    <a href="/index/sort/difficulty" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='difficulty'){ echo "active"; } ?>">難易度 <?php if(session('sort')=='difficulty'){ echo '[' . session('order') . ']'; } ?></a>
    <a href="/index/sort/importance" class="list-group-item list-group-item-action font-weight-bold <?php if(session('sort')=='importance'){ echo "active"; } ?>">重要度 <?php if(session('sort')=='importance'){ echo '[' . session('order') . ']'; } ?></a>
  </ul>
</div>