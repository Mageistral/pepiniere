<div class="form-group form-filter">
    {{-- <label for="i-vigour">{{ __('models.rootstocks_vigours.singular') }}</label> --}}
    <input type="text"
           id="i-vigour"
           name="vigour"
           data-slider-range="true"
           data-slider-min="10"
           data-slider-max="120"
           data-slider-step="10"
           data-slider-lock-to-ticks="true"
           data-slider-tooltip="always"
           data-slider-tooltip-position="bottom"
           data-slider-value="[{{ $vigourValueMin }},{{ $vigourValueMax }}]"
    />
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#i-vigour").slider({
            formatter: function(val) {
                return val[0]+'% - '+val[1]+'%';
            }
        });
    })
</script>
