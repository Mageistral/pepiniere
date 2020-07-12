@extends('layouts.main')
@section('title')
Erreur
@endsection

@section('content')
<div class="alert alert-danger" role="alert">
    {{ session('message') }}
</div>
@endsection