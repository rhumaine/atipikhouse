@extends('layouts.app')
@section('metaog')

    <meta property="og:title" content="Atypikhouse - {{$detailHabitat['titre_habitat']}}" />
    <meta property="og:type" content="Fiche habitat" />
    <meta property="og:url" content="{{route('detailhabitat',$detailHabitat['id_habitat'])}}" />
    @if(!empty($photosHabitat))
        <meta property="og:image" content="{{ asset('public/img/photos/habitats/grandes/'.$photosHabitat[0]['url_photos_habitation']) }}" />
    @endif
    <meta property="og:description" content="{{$detailHabitat['description_fr_habitat']}}" />
    
@endsection
@section('content')


<!-- bannière -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>{{ __('general.properties_detail') }}</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{ route('accueil') }}">{{ __('general.accueil') }}</a></li>
                    <li class="active">{{ __('general.properties_detail') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- fin bannière -->

<div class="properties-details-page content-area">
    <div class="container">
        <div class="row mb-50">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="heading-properties clearfix sidebar-widget">
                    <div class="pull-left">
                        <h3>{{ $detailHabitat['titre_habitat'] }}</h3>
                        @if(isset($noteMoyenne))
                        <div class="habitat-rating">
                            @for ($i = 0; $i < 5; $i++)
                                @if($noteMoyenne > $i)
                                    <i class="fa fa-star"></i>
                                @else
                                    <i class="fa fa-star-o"></i>
                                @endif
                            @endfor
                        </div>
                        @endif
                        <p>
                            <i class="fa fa-map-marker"></i>{{ $detailHabitat['adresse_habitat'] }}, {{ $detailHabitat['code_postal_habitat'] }} {{ strtoupper($detailHabitat['ville_habitat']) }}
                        </p>
                    </div>
                    <div class="pull-right">
                           @if(!empty($dispoHabitat))
                            <h3>
                                <span>

                                        {{ $dispoHabitat[0]['prix_disponibilites'] }}
                                        @if($dispoHabitat[0]['devise_prix_disponibilites'] == "EUR")
                                            €
                                        @else
                                            £
                                        @endif

                                </span>
                            </h3>
                            <h5>
                                {{ __('general.par_nuit') }}
                            </h5>
                            @else
                                <h3>
                                    <span>
                                        {!! __('general.prix_ind') !!}
                                    </span>
                                </h3>
                            @endif
                    </div>
                </div>
                <div class="sidebar-widget mb-40">
                    @if(!empty($photosHabitat))
                        <div class="properties-detail-slider simple-slider mb-40">
                            <div id="carousel-custom" class="carousel slide" data-ride="carousel">
                                <div class="carousel-outer">
                                    <div class="carousel-inner">
                                      @php
                                      $i=0;
                                      @endphp
                                       @foreach($photosHabitat as $photo)
                                        <div class="item @if($i==0) active @endif">
                                            <img src="{{ asset('public/img/photos/habitats/grandes/'.$photo['url_photos_habitation']) }}" class="thumb-preview" alt="{{ $photo['libelle_photo'] }}">
                                        </div>
                                        @php
                                            $i++
                                        @endphp

                                        @endforeach
                                    </div>
                                    <a class="left carousel-control" href="#carousel-custom" role="button" data-slide="prev">
                                        <span class="slider-mover-left no-bg t-slider-r pojison" aria-hidden="true">
                                            <i class="fa fa-angle-left"></i>
                                        </span>
                                        <span class="sr-only">{!! __('pagination.previous') !!}</span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-custom" role="button" data-slide="next">
                                        <span class="slider-mover-right no-bg t-slider-l pojison" aria-hidden="true">
                                            <i class="fa fa-angle-right"></i>
                                        </span>
                                        <span class="sr-only">{!! __('pagination.next') !!}</span>
                                    </a>
                                </div>
                                <ol class="carousel-indicators thumbs visible-lg visible-md">
                                    @php
                                      $i=0;
                                    @endphp
                                    @foreach($photosHabitat as $photo)

                                       <li data-target="#carousel-custom" data-slide-to="{{ $i }}" class="@if($i==0) active @endif"><img src="{{ asset('public/img/photos/habitats/vignettes/'.$photo['url_photos_habitation']) }}" alt="Chevrolet Impala"></li>

                                    @php
                                        $i++
                                    @endphp

                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    @endif
                    <!-- recherche responsive -->
                    <div class="advabced-search hidden-lg hidden-md">
                        <div class="main-title-2">
                            <h1><span>{{ __('general.search') }}</span> {{ __('general.advanced') }}</h1>
                        </div>
                        <form action="{{ route('recherche') }}" method="GET">
                            <div class="row">
                               <div class="col-xs-12">
                                    <div class="form-group">
                                        <input id="inputDestination" type="text" name="destination" class="search-fields" autocomplete="on" style="width:100%;padding-left:10px" placeholder="{!! __('general.destination') !!}">
                                        <input id="locality" type="hidden" name="ville">
                                        <input id="country" type="hidden" name="pays">
                                        <input id="latitude" type="hidden" name="latitude">
                                        <input id="longitude" type="hidden" name="longitude">
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <select class="selectpicker search-fields" name="property-status" data-live-search="true" data-live-search-placeholder="Rechercher...">
                                            <option>Type d'hébergement</option>
                                            @foreach($listeTypesHabitat as $type)
                                                <option>{{ $type->libelle_fr_types_bien }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <select class="selectpicker search-fields" name="bedrooms" data-live-search="true" data-live-search-placeholder="Rechercher...">
                                            <option>Capacité</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <button class="search-button">Rechercher</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- fin recherche responsive -->

                    <!-- description -->
                    <div class="properties-description mb-40 ">
                        <div class="main-title-2">
                            <h1><span>Description</span></h1>
                        </div>
                        <p>{!! $detailHabitat['description_fr_habitat'] !!}</p>
                    </div>

                    <!-- liste des meubles de l'habitat -->
                    <div class="properties-condition mb-40 ">
                        <div class="main-title-2">
                            <h1><span>Informations</span></h1>
                        </div>
                        <div class="row" style="padding-left: 20px;">
                            <dl>
                                <div class="col-md-4 col-sm-4 col-xs-6 info-habitat">
                                    <dt>{!! __('general.superficie') !!}</dt>
                                    <dd>{{ $detailHabitat['surface_m2_habitat'] }} m²</dd>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 info-habitat">
                                    <dt>{!! __('general.capacite') !!}</dt>
                                    <dd>{{ $detailHabitat['capacite_habitat'] }}</dd>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 info-habitat">
                                    <dt>{!! __('general.beds_simple') !!}</dt>
                                    <dd>{{ $detailHabitat['nb_lit_simple_habitat'] }}</dd>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 info-habitat">
                                    <dt>{!! __('general.beds_double') !!}</dt>
                                    <dd>{{ $detailHabitat['nb_lit_double_habitat'] }}</dd>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 info-habitat">
                                    <dt>{!! __('general.smoker') !!}</dt>
                                    <dd>@if($detailHabitat['nb_lit_double_habitat'] == 0)
                                            Non
                                        @else
                                            Oui
                                        @endif
                                    </dd>
                                </div>
                                @foreach($champsSupplementaires as $champ)
                                    @if(app()->getLocale() == "fr")
                                        <div class="col-md-4 col-sm-4 col-xs-6 info-habitat">
                                            <dt>{{ $champ->libelle_fr_champ_habitat }}</dt>
                                            <dd>{{ $champ->valeur }}</dd>
                                        </div>
                                    @else
                                        <div class="col-md-4 col-sm-4 col-xs-6 info-habitat">
                                            <dt>{{ $champ->libelle_en_champ_habitat }}</dt>
                                            <dd>{{ $champ->valeur }}</dd>
                                        </div>
                                    @endif
                                @endforeach
                            </dl>
                        </div>
                    </div>
                    <!-- Fin liste des meubles de l'habitat -->

                    <!-- Liste des équipements -->
                    <div class="properties-condition mb-40 ">
                        <div class="main-title-2">
                            <h1><span>{{ __('general.amenities') }}</span></h1>
                        </div>
                        <div class="row">
                          <ul>
                           @foreach($equipementHabitat as $equipement)
                               @if(app()->getLocale() == "fr")
                                    <li class="col-md-4 col-sm-4 col-xs-6"><i class="flaticon-{{ $equipement['icon'] }}"></i>{{ $equipement['libelle_fr_types_equipement'] }}</li>
                                @else
                                     <li class="col-md-4 col-sm-4 col-xs-6"><i class="flaticon-{{ $equipement['icon'] }}"></i>{{ $equipement['libelle_en_types_equipement'] }}</li>
                                @endif
                           @endforeach
                           </ul>
                        </div>
                    </div>
                    <!-- réglement -->
                    <div class="properties-description mb-40 ">
                        <div class="main-title-2">
                            <h1><span>{{ __('general.settlement') }}</span></h1>
                        </div>
                        <p>{!! $detailHabitat['reglement_fr_habitat'] !!}</p>
                    </div>
                </div>

                <!-- map -->
                <div class="location sidebar-widget">
                    <div class="map">
                        <div class="main-title-2">
                            <h1><span>{{ __('general.location') }}</span></h1>
                        </div>
                        <div id="map" class="contact-map"></div>
                    </div>
                </div>

                <!-- Commentaires -->
                 @if(Auth::check())
                    @if(Auth::user()->id == $detailHabitat['id_user'])
                
                       <a href="{{ route('habitat.modify',$detailHabitat['id_habitat']) }}"><button class="button-md button-theme">{{ __('general.modify') }}</button></a>
                
                    @else
                    
                        <div class="Properties-details-section sidebar-widget">
                            <div class="properties-comments mb-40">
                                <div class="comments-section">
                                    <div class="main-title-2">
                                        <h1><span>Commentaires</span></h1>
                                    </div>

                                    <ul class="comments">
                                        @foreach($listeCommentaires as $commentaire)
                                        <li>
                                            <div class="comment">
                                                <div class="comment-author">
                                                    <a href="#">
                                                        <img src="{{ $commentaire->avatar }}" alt="avatar">
                                                    </a>
                                                </div>
                                                <div class="comment-content">
                                                    <div class="comment-meta">
                                                        <div class="comment-meta-author">
                                                            {{ $commentaire->name }}
                                                        </div>
                                                        <div class="comment-meta-date">
                                                            <span class="hidden-xs">{{ date('d/m/Y', strtotime($commentaire->created_at)) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="comment-body">
                                                        <div class="comment-rating">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if($commentaire->note_commentaire > $i)
                                                                    <i class="fa fa-star"></i>
                                                                @else
                                                                    <i class="fa fa-star-o"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <p>{{ $commentaire->texte_commentaire }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        <!-- formulaire commentaire -->
                        @if($showForm == "ko")
                        <div class="contact-1">
                            <div class="contact-form">
                                <div class="main-title-1">
                                    <h4>{!! __('general.post_comment') !!}</h4>
                                </div>
                                <form action="{{ route('commentaire.poster') }}" method="POST">
                                   @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <select id="star-rating" name="note">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group message">
                                                <textarea class="input-text" name="commentaire" placeholder="{!! __('general.your_comment') !!}..."></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_habitat" value="{{ $detailHabitat['id_habitat'] }}">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group send-btn mb-0">
                                                <button type="submit" class="button-md button-theme">{!! __('general.send') !!}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
                    
                    @endif
                @endif
                

            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <!-- sidebar -->
                <div class="sidebar right">
                   <div class="sidebar-widget helping-box clearfix">
                       <!-- Vérification disponibilités -->
                       @if(Auth::check())
                            @if(Auth::user()->id == $detailHabitat['id_user'])
                               <a href="{{ route('habitat.getdispo',$detailHabitat['id_habitat']) }}"><button class="button-md button-theme">{{ __('general.gerer_dispos') }}</button></a>
                            @else
                                <div class="main-title-2" style="margin-bottom:0">
                                    <h1>{!! __('general.verify_dispo') !!}</h1>
                                    <div class="submit-address">
                                        <form id="formReservation" method="POST" action="{{ route('reservationHabitat', $detailHabitat['id_habitat']) }}">
                                            @csrf
                                            <div class="form-group">
                                               <input type="text" class="input-text" name="daterange" value=""/>
                                            </div>

                                            <input type="hidden" id="date-start" name="date-start" value=""/>
                                            <input type="hidden" id="date-end" name="date-end" value=""/>

                                            <button id="button-resa" type="submit" class="button-md button-theme btn-block" style="display:none">
                                                {{ __('auth.reservation') }}
                                            </button>
                                            <p id="no-dispo" style="display:none">Aucune disponibilités à ces dates</p>
                                        </form>
                                    </div>
                                </div>
                                <p id="long_duree">{!! __('general.long_duree') !!}</p>
                            @endif
                        @else
                       Pour réserver, <a href="{{ route('register') }}">créez un compte</a> ou <a href="{{ route('login') }}">connectez-vous</a>.
                        @endif
                        
                    </div>
                    <!-- recherche -->
                    <div class="sidebar-widget hidden-sm hidden-xs">
                        <div class="main-title-2">
                            <h1><span>{{ __('general.search') }}</span> {{ __('general.advanced') }}</h1>
                        </div>

                        <form action="{{ route('recherche') }}" method="GET">
                            <div class="row">
                               <div class="col-xs-12">
                                    <div class="form-group">
                                        <input id="inputDestination" type="text" name="destination" class="search-fields" autocomplete="on" style="width:100%;padding-left:10px" placeholder="{!! __('general.destination') !!}">
                                        <input id="locality" type="hidden" name="ville">
                                        <input id="country" type="hidden" name="pays">
                                        <input id="latitude" type="hidden" name="latitude">
                                        <input id="longitude" type="hidden" name="longitude">
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <select class="selectpicker search-fields" name="property-status" data-live-search="true" data-live-search-placeholder="Rechercher...">
                                            <option>Type d'hébergement</option>
                                            @foreach($listeTypesHabitat as $type)
                                                <option>{{ $type->libelle_fr_types_bien }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <select class="selectpicker search-fields" name="bedrooms" data-live-search="true" data-live-search-placeholder="Rechercher...">
                                            <option>{!! __('general.capacite') !!}</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <button class="search-button">{{ __('general.search') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if(!empty($lastHabitatById))
                    <!-- Suggestion -->
                    <div class="sidebar-widget helping-box clearfix">
                        <div class="main-title-2" style="margin-bottom:0">
                            <h1>{!! __('general.suggest_habitat') !!}</h1>
                            <div class="suggestion-habitat popular-posts">
                                @foreach($lastHabitatById as $h)

                                    <div class="media ">
                                        <div class="media-left">
                                           @if (!empty($h->url_photos_habitation))
                                                <img class="media-object" src="{{ asset('public/img/photos/habitats/vignettes/'.$h->url_photos_habitation) }}" alt="small-properties-1">
                                            @else
                                                <img class="media-object" src="{{ asset('public/img/photos/habitats/vignettes/default.jpg') }}" alt="small-properties-1">
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading">
                                                <a href="{{ route('detailhabitat', $h->id_habitat) }}">{{$h->titre_habitat}}</a> ({{ round($h->distance) }} km)
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
                    </div>
                    @endif
                    <!-- Fin suggestion -->

                    @if(!empty($lastHabitatById))
                    <!-- activites -->
                    <div class="sidebar-widget helping-box clearfix">
                        <div class="main-title-2" style="margin-bottom:0">
                            <h1>{!! __('general.activities_hab') !!}</h1>
                            <div class="suggestion-habitat popular-posts">
                                @foreach($listActivites as $a)

                                    <div class="media "></div>
                                        <div class="media-body">
                                            <h3 class="media-heading">
                                                <a href="{{ route('detailactivite', $a->id_activites) }}">{{$a->libelle_fr_activites}}</a> ({{ round($a->distance) }} km)
                                            </h3>
                                            <p>{{ $a->ville_activites }}, {{ $a->code_postal_activites }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- Fin activites -->

                     <!-- Réseaux sociaux -->
                    <div class="social-media sidebar-widget clearfix">
                        <div class="main-title-2">
                            <h1>{!! __('general.social_media') !!}</h1>
                        </div>
                        <ul class="social-list">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=@php 
                                echo urlencode(route('detailhabitat',$detailHabitat['id_habitat']));
                            @endphp" class="facebook-bg" target="_blank" onclick="open('https://www.facebook.com/sharer/sharer.php?u=@php 
                                echo urlencode(route('detailhabitat',$detailHabitat['id_habitat']));
                            @endphp', 'Popup', 'scrollbars=1,resizable=1,height=560,width=770'); return false;"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/intent/tweet?url=@php
                                echo urlencode(route('detailhabitat',$detailHabitat['id_habitat']));
                            @endphp" target="_blank" onclick="open('https://twitter.com/intent/tweet?url=@php
                                echo urlencode(route('detailhabitat',$detailHabitat['id_habitat']));
                            @endphp', 'Popup', 'scrollbars=1,resizable=1,height=560,width=770'); return false;" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#" class="google-bg"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" class="rss-bg"><i class="fa fa-rss"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- Fin sidebar -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

    <script type="text/javascript">
        $(function() {
            $('#star-rating').barrating({
                theme: 'fontawesome-stars',
                initialRating : 1,
            });
        });
    </script>
    <script>

    $(document).ready(function(){

        var lat = "{{ $detailHabitat['latitude'] }}";
        var long = "{{ $detailHabitat['longitude'] }}";

        var defaultLat = lat;
        var defaultLng = long;
        var mapOptions = {
            center: new google.maps.LatLng(defaultLat, defaultLng),
            zoom: 15,
            scrollwheel: false,
            styles : [
                {
                    "featureType": "administrative",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        },
                        {
                            "color": "#fcfcfc"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        },
                        {
                            "color": "#fcfcfc"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        },
                        {
                            "color": "#dddddd"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        },
                        {
                            "color": "#dddddd"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        },
                        {
                            "color": "#eeeeee"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        },
                        {
                            "color": "#dddddd"
                        }
                    ]
                }
            ]
        };
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var infoWindow = new google.maps.InfoWindow();
        var myLatlng = new google.maps.LatLng(lat, long);

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map
        });
        (function (marker) {
            google.maps.event.addListener(marker, "click", function (e) {
                infoWindow.setContent("" +
                    "<div class='map-properties contact-map-content'>" +
                    "<div class='map-content'>" +
                    "<p class='address'>123 Kathal St. Tampa City, </p>" +
                    "<ul class='map-properties-list'> " +
                    "<li><i class='fa fa-phone'></i>  +0477 8556 552</li> " +
                    "<li><i class='fa fa-envelope'></i>  info@themevessel.com</li> " +
                    "<li><a href='index.html'><i class='fa fa-globe'></i>  http://http://themevessel.com</li></a> " +
                    "</ul>" +
                    "</div>" +
                    "</div>");
                infoWindow.open(map, marker);
            });
        })(marker);

    });

    $(function() {
        var today = new Date();
        let dateRanges = <?php echo json_encode($reservation); ?> ;
        let dateRangesDispo = <?php echo json_encode($allDispo); ?> ;
        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            "autoApply": false,
            minDate: moment(),
            selectPastInvalidDate: false,
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Valider",
                "cancelLabel": "Annuler",
                "fromLabel": "De",
                "toLabel": "à",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "Dim",
                    "Lun",
                    "Mar",
                    "Mer",
                    "Jeu",
                    "Ven",
                    "Sam"
                ],
                "monthNames": [
                    "Janvier",
                    "Février",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Août",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Décembre"
                ],
                "firstDay": 1
            },
            "startDate": today.getDay() + today.getMonth() + today.getYear(),
            "endDate": today.getDay() + today.getMonth() + today.getYear(),
            isInvalidDate: function(date) {

                return dateRanges.reduce(function(bool, range) {
                    return bool || (date >= moment(range.start) && date <= moment(range.end));
                }, false);

              }
            },
            function(start, end, label) {

                $.each(dateRangesDispo, function(i, val) {
                    if(start.format('YYYY-MM-DD') >= val.date_debut_disponibilites && end.format('YYYY-MM-DD') <= val.date_fin_disponibilites){
                        $('#date-start').val(start.format('DD-MM-YYYY'));
                        $('#date-end').val(end.format('DD-MM-YYYY'));
                        $('#button-resa').show();
                        $('#no-dispo').hide();
                        return false;
                    }else{
                        $('#button-resa').hide();
                        $('#no-dispo').show();
                    }
                });

            });
        });
</script>

<script>
    function initialize() {
            var componentForm = {
                locality: 'long_name',
                country: 'long_name',
            };
            var options = {
                types: ['(cities)'],
            };

            var input = document.getElementById('inputDestination');
            var autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.addListener('place_changed', fillInAddress);


            function fillInAddress() {

                var place = autocomplete.getPlace();


                for (var component in componentForm){
                  document.getElementById(component).value = '';
                  document.getElementById(component).disabled = false;
                }


                var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng();

                for (var i = 0; i < place.address_components.length; i++) {
                  var addressType = place.address_components[i].types[0];
                  if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                  }
                }

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }
       }

       google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endsection
