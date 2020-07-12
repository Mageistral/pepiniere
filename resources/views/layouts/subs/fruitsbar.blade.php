@foreach ($fruits as $fruit)
    @if (!empty($current_fruit) && ($fruit->id == $current_fruit->id))
        <div class="col-sm-1 nav-item current-item">
    @else
        <div class="col-sm-1 nav-item">
    @endif
    <a href="{{ url($fruit->name, [$fruit->id]) }}">
    <img src="{{ asset('/img/fruits/'.$fruit->name.'.svg') }}" />
    {{ $fruit->name }}
    </a>
</div>
@endforeach