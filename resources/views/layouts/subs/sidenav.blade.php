{{-- Card de la recherche en direct JS sur le nom --}}
<div class="card card-text-filter">
    <div class="card-header">{{ __('front.search_title') }}</div>
    <div class="card-body">
        <div class="container">
        <input id="i-filter-text" type="text" name="filter-text" placeholder="{{ __('front.search_title_placeholder') }}" />
        </div>
    </div>
</div>
<div class="card card-text-filter">
    <div class="card-header">{{ __('front.search_content') }}</div>
    <div class="card-body">
        <div class="container">
        <input id="i-filter-content" type="text" name="filter-content" placeholder="{{ __('front.search_content_placeholder') }}" />
        </div>
    </div>
</div>
<form id="formFilters" action="{{ url()->current() }}" method="GET">
    {{-- Card dédiée à la vigueur --}}
    <div class="card">
        <div class="card-header">{{ __('models.rootstocks_vigours.singular') }}<br />
            {{-- <button type="submit" class="btn btn-primary">Filtrer</button><br /> --}}
            <small>{{ __('models.rootstocks_vigours.related_to_not_grafted') }}</small>
        </div>
        <div class="card-body">
            <div class="container">
                {{-- si la vigueur est renseignée, on prend les valeurs sinon défaut dans la conf --}}
                @if (! empty($inputs['vigour']))
                    @include('Rootstock.height_mean', [
                        'vigourValueMin' => preg_split('/,/', $inputs['vigour'])[0],
                        'vigourValueMax' => preg_split('/,/', $inputs['vigour'])[1]
                    ])
                @else
                    @include('Rootstock.height_mean', [
                        'vigourValueMin' => config('rootstocks.front_height_min'),
                        'vigourValueMax' => config('rootstocks.front_height_max')
                    ])
                @endif
            </div>
        </div>
    </div>
@foreach ($categories as $category)
    <div class="card">
        <div class="card-header">{{ $category->name }}<br />
            {{-- <button type="submit" class="btn btn-primary">Filtrer</button><br /> --}}
            <small>a minima ...</small>
        </div>
        <div class="card-body">
            <div class="container">
                {{-- récupération des spécificités de la catégorie --}}
                @foreach ($specificities->where('category_id', $category->id) as $specificity)
                    @include('Specificity.filter', [
                        'randStr' => Str::random(6),
                        'specificityId' => $specificity->id,
                        'specificityValue' => $inputs['specificity-'.$specificity->id] ?? null
                    ])
                @endforeach
            </div>
        </div>
    </div>
@endforeach
</form>