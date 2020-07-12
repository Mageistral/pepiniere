@php
    use App\Models\Level;
@endphp
<div class="col">
    <div class="card spec-category">
        <div class="card-header">
            {{ $category->name }}
        </div>
        <div class="card-body">
            @foreach ($specificities->where('category_id', $category->id) as $specificity)
                @if ($rootstock->specificities()->find($specificity->getKey()))
                    <div class="spec-name">{{ $specificity->getShortName() }}</div>
                    @include('Specificity.gauge', [
                        'level' => Level::find($rootstock->specificities()
                                        ->find($specificity->getKey())
                                        ->pivot->level_id)
                    ])
                @endif
            @endforeach
        </div>
    </div>
</div>