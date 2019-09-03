<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>AtypikHouse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap-submenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/leaflet.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/css/map.css') }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/fonts/linearicons/style.css') }}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('public/css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('public/css/dropzone.css') }}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('public/css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('public/css/skins/default.css') }}">

    <!-- Favicon  -->
    <link rel="shortcut icon" href="{{ asset('public/img/favicon.ico') }}" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/ie10-viewport-bug-workaround.css') }}">
    <script src="{{ asset('public/js/ie-emulation-modes-warning.js') }}"></script>
</head>
<body>

<div class="page_loader"></div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="error404-content">
                <h1>404</h1>
                <h2>{!! __('general.something_wr') !!}</h2>
                <p>{!! __('general.404_txt') !!}.</p>
                    <a href="{{ route('accueil') }}">
                        <button class="button-sm out-line-btn">
                        {!! __('general.back_home') !!}
                        </button>
                    </a>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('public/js/jquery-2.2.0.min.js') }}"></script>
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/bootstrap-submenu.js') }}"></script>
<script src="{{ asset('public/js/rangeslider.js') }}"></script>
<script src="{{ asset('public/js/jquery.mb.YTPlayer.js') }}"></script>
<script src="{{ asset('public/js/wow.min.js') }}"></script>
<script src="{{ asset('public/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('public/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('public/js/jquery.scrollUp.js') }}"></script>
<script src="{{ asset('public/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('public/js/leaflet.js') }}"></script>
<script src="{{ asset('public/js/leaflet-providers.js') }}"></script>
<script src="{{ asset('public/js/leaflet.markercluster.js') }}"></script>
<script src="{{ asset('public/js/dropzone.js') }}"></script>
<script src="{{ asset('public/js/jquery.filterizr.js') }}"></script>
<script src="{{ asset('public/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('public/js/maps.js') }}"></script>
<script src="{{ asset('public/js/app_theme.js') }}"></script>
<script src="{{ asset('public/js/ie10-viewport-bug-workaround.js') }}"></script>
<script src="{{ asset('public/js/ie10-viewport-bug-workaround.js') }}"></script>

</body>
</html>
