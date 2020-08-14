@switch($todo->difficulty)
  @case(1)
    <?php $difficult = '低'; ?>
    @break
  @case(2)
    <?php $difficult = '中'; ?>
    @break
  @case(3)
    <?php $difficult = '高'; ?>
    @break
@endswitch

@switch($todo->importance)
  @case(1)
    <?php $importance = '低'; ?>
    @break
  @case(2)
    <?php $importance = '中'; ?>
    @break
  @case(3)
    <?php $importance = '高'; ?>
    @break
@endswitch

<h6 class="card-subtitle mb-2 text-body">難易度：{{ $difficult }}</h6>
<h6 class="card-subtitle mb-2 text-body">重要度：{{ $importance }}</h6>
