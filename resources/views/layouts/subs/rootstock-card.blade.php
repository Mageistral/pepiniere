<div class="card rootstock">
    <div class="card-header">
        {{ $rootstock->name }}
        @if ($rootstock->name_alternate)
            <div class="small">{{ $rootstock->name_alternate }}</div>
        @endif
        @if ($rootstock->latin_name)
            <div class="latin-name" data-toggle="tooltip" data-placement="top" title="{{ $rootstock->latin_name }}">
                <i class="la la-landmark"></i>
            </div>
        @endif
    </div>
    <div class="card-body">
        @if ((!empty($rootstock->computed_vigour)) || (!empty($rootstock->height_mean)))
        {{-- Hauteur --}}
        <div class="row">
            <div class="col-md-auto">
                <div class="spec-icon" data-toggle="tooltip" data-placement="top" title="{{ __('models.rootstocks.height_mean') }}">
                    <i class="la la-arrows-alt-v"></i>
                </div>
            </div>
            <div class="col-md-auto">
                &nbsp;{{ $rootstock->computed_vigour ?? $rootstock->height_mean }}&nbsp;cm
                @isset($franc)
                ({{ intval($rootstock->computed_vigour / $franc->height_mean * 100) }}&nbsp;%)
                @endisset
            </div>
        </div>
        @endisset
        @isset($rootstock->lifetime)
        {{-- Durée de vie --}}
        <div class="row">
            <div class="col-md-auto">
                <div class="spec-icon" data-toggle="tooltip" data-placement="top" title="{{ __('models.rootstocks.lifetime') }}">
                    <i class="la la-birthday-cake"></i>
                </div>
            </div>
            <div class="col-md-auto">
                &nbsp;{{ $rootstock->lifetime }}&nbsp;ans
            </div>
        </div>
        @endisset
        @isset($rootstock->first_fruits_years)
        {{-- Durée de vie --}}
        <div class="row">
            <div class="col-md-auto">
                <div class="spec-icon" data-toggle="tooltip" data-placement="top" title="{{ __('models.rootstocks.first_fruits_years') }}">
                    <i class="la la-apple-alt"></i>
                </div>
            </div>
            <div class="col-md-auto">
                &nbsp;{{ $rootstock->first_fruits_years }}&nbsp;ans
            </div>
        </div>
        @endisset
        {{-- Affichage d'une card par catégorie de spécificités --}}
        @foreach ($categories as $category)
            {{-- Dans toutes les spécificités présentes sur la page, dans cette catégorie,
            on prend celles qui sont également présentes dans le porte-greffe courant
            on calcule ça en faisant un intersect de ces 2 tableaux d'ids --}}
            @if ($specificities->where('category_id', $category->id)->pluck('id')
            ->intersect($rootstock->specificities->pluck('id'))->count() > 0)
                <div class="row">
                    @include('Specificity.category-in-card')
                </div>
            @endif
        @endforeach
        {{-- </div>
            @foreach ($rootstock->specificities as $specificity)
                @if (($loop->index % 3 == 0) && (! $loop->first))
                    </div>
                    <div class="row">
                @endif
                @include('Specificity.gauge')
            @endforeach
        </div> --}}
    </div>
</div>