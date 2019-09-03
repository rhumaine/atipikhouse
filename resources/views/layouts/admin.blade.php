<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>AtypikHouse - {{ __('general.baseline') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link rel="shortcut icon" href="{{ asset('public/img/favicon.png') }}" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/ie10-viewport-bug-workaround.css') }}">
    <script src="{{ asset('public/js/ie-emulation-modes-warning.js') }}"></script>

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=bzqx7xtsir7008u6iocd125snp8gw2oe4y1pptaaf19kkaow"></script>
    <script>tinymce.init({ selector:'textarea' });</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120916748-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-120916748-1');
</script>

</head>
<body>

<div class="page_loader"></div>


<header class="main-header">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navigation" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ route('accueil') }}" class="logo">
                    <img src="{{ asset('public/img/logos/atypikhouse_logo.png') }}" alt="logo">
                </a>
            </div>

            <div class="navbar-collapse collapse" role="navigation" aria-expanded="true" id="app-navigation">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('admin') }}">{!! __('general.admin_home') !!}</a></li>
                    <li><a href="{{ route('admin.users') }}">{!! __('general.users') !!}</a></li>
                    <li><a href="{{ route('admin.params') }}">{!! __('general.hab_params') !!}</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right rightside-navbar">
                    <div class="dropdown">
                      <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="button-dropdown">
                        {!! __('general.my_account') !!}
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dLabel">
                        <li>
                            <a href="{{ route('user.profil') }}">{!! __('general.my_profile') !!}</a>
                            @if(Auth::user()->admin == 1)
                                <a href="{{ route('admin') }}">Administration</a>
                            @endif
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Déconnexion
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                      </ul>
                    </div>
                </ul>
            </div>
        </nav>
    </div>
</header>


@yield('content')


<div class="copy-right">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8 col-sm-12">
                &copy;  {{ date('Y') }} <a href="http://atypikhouse.com/" target="_blank">AtypikHouse</a>. {{ __('general.copyright') }}.
            </div>
            <div class="col-md-4 col-sm-12">
                <ul class="social-list clearfix">
                    <li>
                        <a href="#" class="facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="linkedin">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="google">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="rss">
                            <i class="fa fa-rss"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXVO8Xx64rn_SxicqI5tcKPkLnsPK7Mig&libraries=places"></script>

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
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('public/css/daterangepicker.css') }}" />
<script type="text/javascript" src="{{ asset('public/js/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/daterangepicker.js') }}"></script>

@yield('script')

</body>
</html>
