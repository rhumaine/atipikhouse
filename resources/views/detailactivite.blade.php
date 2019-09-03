@extends('layouts.app')
@section('metaog')


@endsection
@section('content')

<!-- Bannière -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>{{ __('general.activity') }}</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{ route('accueil') }}">{{ __('general.accueil') }}</a></li>
                    <li class="active">{{ __('general.activity') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Fin bannière -->


<div class="properties-details-page content-area">
    <div class="container">
        <div class="row mb-50">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="heading-properties clearfix sidebar-widget">
                    <div class="pull-left">
                        <h3>{{ $libelle_fr_activites }}</h3>
                    </div>
                    <div class="pull-right">
                            <h3>
                                <span>

                                    {{ $prix_activites }}
                                    @if($devise_prix_activites == "EUR")
                                        €
                                    @else
                                        £
                                    @endif

                                </span>
                            </h3>
                    </div>
                </div>
                <div class="sidebar-widget mb-40">
                    <!-- Recherche en responsive -->
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
                    <!-- Fin recherche en responsive -->

                    <!-- Description -->
                    <div class="properties-description mb-40 ">
                        <div class="main-title-2">
                            <h1><span>Description</span></h1>
                        </div>
                        <p>{{$description_activites}}</p>
                    </div>
                    <!-- fin description -->

                </div>

                <!-- Map -->
                <div class="location sidebar-widget">
                    <div class="map">
                        <div class="main-title-2">
                            <h1><span>{{ __('general.location') }}</span></h1>
                        </div>
                        <div id="map" class="contact-map"></div>
                    </div>
                </div>
                <!-- Fin map-->
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <!-- Sidebar -->
                <div class="sidebar right">
                    <!-- recherche sidebar -->
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
                    <!-- end suggestion -->
                     <!-- réseaux sociaux -->
                    <div class="social-media sidebar-widget clearfix">
                        <div class="main-title-2">
                            <h1>{!! __('general.social_media') !!}</h1>
                        </div>
                        <ul class="social-list">
                            <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#" class="google-bg"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" class="rss-bg"><i class="fa fa-rss"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- fin sidebar -->
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
                initialRating : 3,
            });
        });
    </script>
    <script>

    $(document).ready(function(){

        var lat = "{{ $latitude }}";
        var long = "{{ $longitude }}";

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

                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();


                for (var component in componentForm){
                  document.getElementById(component).value = '';
                  document.getElementById(component).disabled = false;
                }


                var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng();


                // Get each component of the address from the place details
                // and fill the corresponding field on the form.
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
