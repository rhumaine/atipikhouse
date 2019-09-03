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

<div class="content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

               <div class="text-center">
                    <a href="{{ route('accueil') }}">
                        <img src="{{ asset('public/img/logos/atypikhouse_logo.png') }}" alt="logo">
                    </a>
               </div>


                <div class="form-content-box">

                    <!-- details -->
                    <div class="details">
                        <!-- Main title -->
                        <div class="main-title">
                            <h1>{{ __('auth.login') }}</h1>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <input id="email" type="email" class="input-text form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ __('auth.E-Mail Address') }}">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="input-text form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ __('auth.Password') }}">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="checkbox">
                            <div class="ez-checkbox pull-left">
                                <label>
                                    <input type="checkbox" class="ez-hide" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('auth.Remember Me') }}
                                </label>
                            </div>
                            <a class="link-not-important pull-right" href="{{ route('password.request') }}">
                                    {{ __('auth.nopassword') }}
                                </a>
                            <div class="clearfix"></div>
                        </div>

                        <button type="submit" class="button-md button-theme btn-block">
                            {{ __('auth.login') }}
                        </button>

                        </form>
                        <hr>
                                            
                    <p class="text-center">
<!--
                        <a href="/facebook" class="button-md btn-block btn-facebook">Facebook</a>
                        <a href="/google" class="button-md btn-block btn-google">Google</a>
-->
                        <a href="/facebook"><img src="{{ asset('public/img/logos/facebook.png') }}" alt="Facebook"></a>
                        <a href="/google"><img src="{{ asset('public/img/logos/googleplus.png') }}" alt="Google plus"></a>
                        
                    </div>
                    <!-- Footer -->
                    <div class="footer">
                        <span>
                            {{ __('auth.noaccount') }}<a href="{{ route('register') }}"> {{ __('auth.register') }}</a>
                        </span>
                    </div>
                </div>
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
