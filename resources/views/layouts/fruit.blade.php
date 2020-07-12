@extends('layouts.main')
@section('title')
{{ config('app.name') }} - {{ ucfirst($current_fruit->name) }}
@endsection

@section('content')

@if ((! empty($rootstocks)) && ($rootstocks->count() > 0))
    <div class="content-intro">Porte-greffes triés par vigueur croissante. Porte-greffes à la vigueur inconnue au début.</div>
    @foreach ($rootstocks as $rootstock)
        @include('layouts.subs.rootstock-card')
    @endforeach
@else
    Pas de porte-greffe correspondant.
@endif
@endsection