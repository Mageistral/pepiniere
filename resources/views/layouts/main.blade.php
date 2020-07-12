<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/tree.svg') }}">
        <link rel="icon" href="{{ asset('img/tree.svg') }}" type="image/svg+xml">
        
        <link rel="manifest" href="{{ asset('img/tree.svg') }}">
        <link rel="shortcut icon" href="{{ asset('img/tree.svg') }}">
    
        <!-- Load fonts -->
        {{-- <link rel="stylesheet" href="https://use.typekit.net/ins2wgm.css"> --}}
    
        <!-- Load styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/layout.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-slider.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/line-awesome.min.css') }}">
    
        <!-- Load JS -->
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap-slider.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front.js') }}" type="text/javascript"></script>
    </head>
    <body>
        <div class="container text-center">
            {{-- intégralité de la div header --}}
            <div class="row">
                @include('layouts.subs.header')
            </div>
            {{-- FIN div header --}}
            {{-- navbar des fruits --}}
            <div class="row fruitsbar justify-content-md-center">
                @include('layouts.subs.fruitsbar')
            </div>
            {{-- FIN navbar des fruits --}}
            <div class="row">
                @if (empty($categories))
                    <div class="offset-lg-4 col-lg-8 text-left content">
                @else
                    <div class="col-lg-4 sidenav">
                        @include('layouts.subs.sidenav')
                    </div>
                    <div class="col-lg-8 text-left content">
                @endif
                @yield('content')
            </div>
            
            <footer class="container text-center">
                <div class="mention">Icônes des fruits par <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> sur <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
            </footer>
        </div>
        
    </body>
</html>