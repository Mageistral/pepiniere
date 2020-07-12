
<div class="form-group form-filter {{ $specificityValue ? 'filter-in-use' : '' }}">
    <label for="i-specificity-{{ $specificity->id}}">{{ $specificity->name }}</label>
    <input type="text"
           id="i-specificity-{{ $specificity->id}}"
           name="specificity-{{ $specificity->id}}"
           data-slider-ticks=@json( $levels->sortBy('weight')->pluck('weight')->toJson() )
           data-slider-lock-to-ticks="true"
           data-slider-tooltip="always"
           data-slider-tooltip-position="bottom"
           data-slider-value="{{ $specificityValue }}"
    />
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#i-specificity-{{ $specificity->id }}").slider({
            formatter: function(val) {
                var jsonMap = JSON.parse('@json($levels->map(function ($item, $key) { return $item->only(['name', 'weight']); })->keyBy('weight'))');
                return jsonMap[val].name;
            }
        });
    })
</script>
