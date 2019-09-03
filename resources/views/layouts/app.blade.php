<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>AtypikHouse - {{ __('general.baseline') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta property="fb:app_id" content="190297315164957" /> 
    <meta property="og:title" content="Atypikhouse - Hebergements insolites" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.atypikhouse.fr/" />
    <meta property="og:image" content="{{ asset('public/img/logos/atypikhouse_logo.png') }}" />
    <meta property="og:description" content="Réserver votre logement atypique partout dans le monde et profiter d'activités inoubliables. Partez à la découverte de nombreux hébergements atypiques et réservez votre coup de coeur directement en ligne sur Atypikhouse." />
    <meta property="og:locale" content="{{ app()->getLocale() }}" />
    
    @yield('metaog')
    

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap-submenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/fontawesome-stars.css') }}">
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

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/img/favicon.png') }}" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/ie10-viewport-bug-workaround.css') }}">
    <script src="{{ asset('public/js/ie-emulation-modes-warning.js') }}"></script>

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
                @if (Auth::check())
                    <ul class="nav navbar-nav navbar-right rightside-navbar">
                        <div class="dropdown">
                          <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="button-dropdown">
                            Mon compte
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
                @else
                    <ul class="nav navbar-nav navbar-right rightside-navbar">
                        <li>
                            <a href="{{ route('register') }}" class="button2"><i class="fa fa-user"></i> {{ __('auth.register') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class="button"><i class="fa fa-sign-in"></i> {{ __('auth.login') }}</a>
                        </li>
                    </ul>
                @endif
            </div>
        </nav>
    </div>
</header>

@yield('content')



<footer class="main-footer clearfix">
    <div class="container">
        <div class="footer-info">
            <div class="row">
                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-item">
                        <div class="main-title-2">
                            <h1>{{ __('general.contact_us') }}</h1>
                        </div>
                        <ul class="personal-info">
                            <li>
                                <i class="fa fa-map-marker"></i>
                                {{ __('general.adress') }}: 14 Rue Jules Michelet, 60350 Pierrefonds
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i>
                                Email:<a href="mailto:contact@atypikhouse.fr"> contact@atypikhouse.fr</a>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i>
                                Téléphone: <a href="tel:+33370987665"> +33 370 98 76 65</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Liens -->
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="footer-item">
                        <div class="main-title-2">
                            <h1>{{ __('general.links') }}</h1>
                        </div>
                        <ul class="links">
                            <li>
                                <a href="{{ route('accueil') }}#intro">{{ __('general.about_us') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}">{{ __('general.contact_us') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('mentions')}}">{{ __('general.legal_notice') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Habitats populaires -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="footer-item popular-posts">
                        <div class="main-title-2">
                            <h1>{{ __('general.popular') }}</h1>
                        </div>

                         @foreach($global['habitat'] as $h)

                                <div class="media">
                                    <div class="media-left">
                                       @if (!empty($h->url_photos_habitation))
                                            <img class="media-object" src="{{ asset('public/img/photos/habitats/vignettes/'.$h->url_photos_habitation) }}" alt="small-properties-1">
                                        @else
                                            <img class="media-object" src="{{ asset('public/img/photos/habitats/vignettes/default.jpg') }}" alt="small-properties-1">
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">
                                            <a href="{{ route('detailhabitat', $h->id_habitat) }}">{{$h->titre_habitat}}</a>
                                        </h3>
                                        <p>{{ $h->ville_habitat }}, {{ $h->code_postal_habitat }}</p>
                                        <div class="price">
                                            @if(!empty($h->prix_disponibilites))
                                                    {{ $h->prix_disponibilites}}
                                                @if(app()->getLocale() == "fr")
                                                    €
                                                @else
                                                    £
                                                @endif
                                            @else
                                                {!! __('general.prix_ind') !!}
                                            @endif

                                        </div>
                                    </div>
                                </div>
                        @endforeach

                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="footer-item">
                    <img src="{{ asset('public/img/logos/paiement-securise.png') }}" alt="Paiement sécurisé" style="width:60%;margin:0 auto 30px;">
                    <img src="{{ asset('public/img/logos/logo_muskrat.png') }}" alt="Logo Muskrats">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

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
<script src="{{ asset('public/js/jquery.barrating.min.js') }}"></script>
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
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=bzqx7xtsir7008u6iocd125snp8gw2oe4y1pptaaf19kkaow"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('public/css/daterangepicker.css') }}" />
<script type="text/javascript" src="{{ asset('public/js/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/daterangepicker.js') }}"></script>

@yield('script')

</body>
</html>
