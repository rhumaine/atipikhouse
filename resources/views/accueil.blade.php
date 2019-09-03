@extends('layouts.app')
@section('content')

<!-- Bannière -->
<div class="banner">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Carousel bannière -->
        <div class="carousel-inner" role="listbox">
            <div class="item banner-max-height active">
                <img src="{{ asset('public/img/photos/slider1.jpg') }}" alt="banner-slider-1" class="img-responsive">
                <div class="carousel-caption banner-slider-inner">
                    <div class="banner-content">
                        <h1 data-animation="animated fadeInDown delay-05s">{!! __('general.slide_envie') !!}</h1>
                        <p data-animation="animated fadeInUp delay-1s">{!! __('general.slide_envie_txt') !!}</p>
                        <a href="{{ route('habitat.create') }}" class="btn button-md button-theme" data-animation="animated fadeInUp delay-15s">{!! __('general.slide_proprietaire_btn') !!}</a>
                    </div>
                </div>
            </div>
            <div class="item banner-max-height">
                <img src="{{ asset('public/img/photos/slider2.jpg') }}" alt="banner-slider-2" class="img-responsive">
                <div class="carousel-caption banner-slider-inner">
                    <div class="banner-content">
                        <h1 data-animation="animated fadeInDown delay-1s">{!! __('general.slide_proprietaire') !!}</h1>
                        <p data-animation="animated fadeInUp delay-05s">{!! __('general.slide_proprietaire_txt') !!}</p>
                        <a href="{{ route('habitat.create') }}" class="btn button-md button-theme" data-animation="animated fadeInUp delay-15s">{!! __('general.slide_proprietaire_btn') !!}</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- flèches de contrôle -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="slider-mover-left" aria-hidden="true">
                <i class="fa fa-angle-left"></i>
            </span>
            <span class="sr-only">{{ __('pagination.previous') }}</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="slider-mover-right" aria-hidden="true">
                <i class="fa fa-angle-right"></i>
            </span>
            <span class="sr-only">{{ __('pagination.next') }}</span>
        </a>
    </div>
</div>
<!-- Fin bannière -->

<!-- Zone de recherche -->
<div class="search-area">
    <div class="container">
        <div class="search-area-inner">
            <div class="search-contents ">
                <form action="{{ route('recherche') }}" method="GET">
                    <div class="row">
                       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 wow fadeInLeft delay-04s">
                            <div class="form-group">
                                <input id="inputDestination" type="text" name="destination" class="search-fields" autocomplete="on" style="width:100%;padding-left:10px" placeholder="{!! __('general.destination') !!}">
                                <input id="locality" type="hidden" name="ville">
                                <input id="country" type="hidden" name="pays">
                                <input id="latitude" type="hidden" name="latitude">
                                <input id="longitude" type="hidden" name="longitude">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 wow fadeInUp delay-04s">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="type_hebergement" data-live-search="true" data-live-search-placeholder="{!! __('general.rechercher') !!}...">
                                    <option>{!! __('general.type_heb') !!}</option>
                                    @foreach($listeTypesHabitat as $type)
                                        <option value="{{ $type->id_types_bien }}">{{ $type->libelle_fr_types_bien }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 wow fadeInUp delay-04s">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="capacite" data-live-search="true" data-live-search-placeholder="{!! __('general.rechercher') !!}...">
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
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 wow fadeInRight delay-04s">
                            <div class="form-group">
                                <button class="search-button">{!! __('general.rechercher') !!}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin zone de recherche -->


<!-- Description entreprise -->
<div class="about-city-estate mb-70" id="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 wow fadeInLeft delay-04s">
               <img src="{{ asset('public/img/photos/atypikhouse.jpg') }}" class="img-preview img-responsive" alt="properties-3">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="about-text wow fadeInDown delay-04s">
                    @if(app()->getLocale() == "fr")
                        {!! $entreprise[0]->description_fr_entreprise !!}
                    @else
                        {!! $entreprise[0]->description_en_entreprise !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin description entreprise -->

<!-- Nos service -->
<div class="our-service">
    <div class="container">
        <div class="main-title">
            <h1>{!! __('general.home_service') !!}</h1>
        </div>

        <div class="row mgn-btm wow">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInLeft delay-04s">
                <div class="content">
                    <i class="fa fa-home"></i>
                    <h4>{!! __('general.home_logements') !!}</h4>
                    <p>{!! __('general.home_logements_txt') !!}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInLeft delay-04s">
                <div class="content">
                    <i class="fa fa-globe"></i>
                    <h4>{!! __('general.home_tour') !!}</h4>
                    <p>{!! __('general.home_tour_txt') !!}.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInRight delay-04s">
                <div class="content">
                    <i class="fa fa-credit-card"></i>
                    <h4>{!! __('general.home_payment') !!}</h4>
                    <p>{!! __('general.home_payment_txt') !!}.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInRight delay-04s">
                <div class="content">
                    <i class="fa fa-mobile"></i>
                    <h4>{!! __('general.home_application') !!}</h4>
                    <p>{!! __('general.home_application_txt') !!} !</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin nos service -->

<!-- Zone compteur -->
<div class="counters overview-bgi mb-70">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 bordered-right">
                <div class="counter-box">
                    <i class="flaticon-tag"></i>
                    <h1 class="counter">{{ $nbLogements }}</h1>
                    <p>{!! __('general.home_logements') !!}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 bordered-right">
                <div class="counter-box">
                    <i class="flaticon-symbol-1"></i>
                    <h1 class="counter">{{ $nbUsers }}</h1>
                    <p>{!! __('general.users') !!}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 bordered-right">
                <div class="counter-box">
                    <i class="flaticon-people"></i>
                    <h1 class="counter">{{ $nbTypesBien }}</h1>
                    <p>{!! __('general.types_log') !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin zone compteur -->


<!-- Habitat récent -->
<div class="mb-70 recently-properties chevron-icon">
    <div class="container">
        <div class="main-title">
            <h1>{!! __('general.last_log') !!}</h1>
        </div>
        <div class="row">
            <div class="carousel our-partners slide" id="ourPartners2">
                <div class="col-lg-12 mrg-btm-30">
                    <a class="right carousel-control" href="#ourPartners2" data-slide="prev"><i class="fa fa-chevron-left icon-prev"></i></a>
                    <a class="right carousel-control" href="#ourPartners2" data-slide="next"><i class="fa fa-chevron-right icon-next"></i></a>
                </div>
                <div class="carousel-inner">
                    @php $nb = 0; @endphp
                    @foreach($listeDerniersLogements as $logement)

                        <div class="item @if($nb == 0) active @endif">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <!-- Property 2 start -->
                                <div class="property-2">
                                    <!-- Property img -->
                                    <div class="property-img">
                                        <div class="featured">
                                            {{ $logement->libelle_fr_types_bien }}
                                        </div>
                                        <div class="price-ratings">
                                            <div class="price">
                                                @if(!empty($logement->prix_disponibilites))
                                                    {{ $logement->prix_disponibilites }} € / {!! __('general.nuit') !!}
                                                @else
                                                    {!! __('general.prix_ind') !!}
                                                @endif
                                            </div>
                                            @if(isset($logement->note))
                                            <div class="ratings">
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if($logement->note > $i)
                                                        <i class="fa fa-star"></i>
                                                    @else
                                                        <i class="fa fa-star-o"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            @endif

                                        </div>
                                        @if (!empty($logement->url_photos_habitation))
                                            <img src="{{ asset('public/img/photos/habitats/grandes/'.$logement->url_photos_habitation) }}" alt="rp" class="img-responsive">
                                        @else
                                            <img src="{{ asset('public/img/photos/habitats/grandes/default.jpg') }}" alt="rp" class="img-responsive">
                                        @endif
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            <a href="{{ route('detailhabitat', $logement->id_habitat)}}">{{ $logement->titre_habitat }}</a>
                                        </h4>
                                        <p>{{ mb_strimwidth($logement->description_fr_habitat, 0, 120, "...") }}</p>
                                    </div>
                                    <ul class="facilities-list clearfix">
                                        <li>
                                            <i class="fa fa-globe"></i>
                                            <span>{{ $logement->ville_habitat." (".$logement->code_postal_habitat.")" }}</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-users"></i>
                                            <span>{{ $logement->capacite_habitat }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @php $nb ++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin habitat récent -->


<!-- bannière nous rejoindre -->
<div class="intro-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-6 col-xs-12 wow fadeInLeft delay-04s">
                <h3>{!! __('general.looking') !!}</h3>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12 wow fadeInRight delay-04s">
                <a href="{{ route('register') }}" class="btn button-md button-theme">{!! __('general.rejoigneznous') !!}</a>
            </div>
        </div>
    </div>
</div>
<!-- Fin bannière nous rejoindre -->

<!-- Témoignages -->
@if(isset($listeTemoignages[0]))
<div class="testimonials-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 wow fadeInUp delay-04s">
                <div class="sec-title-three">
                    <h4>{!! __('general.ilsontaimé') !!}</h4>
                    <h2>{!! __('general.temoignages') !!}</h2>
                    <div class="text">
                        {!! __('general.acercu_exp') !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 wow fadeInRight delay-04s">
                <div id="carouse3-example-generic" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                       @php $i=0 @endphp
                        @foreach($listeTemoignages as $temoignage)

                        <div class="item content @if($i==0) active @endif clearfix">
                            <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                                <div class="avatar">
                                    <img src="{{ $temoignage->avatar }}" alt="avatar-2" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                <div class="text">
                                    {{ mb_strimwidth($temoignage->texte_commentaire, 0, 200, "...") }}
                                </div>
                                <div class="author-name">
                                    {{ $temoignage->name }}
                                </div>
                                <div class="comment-rating">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if($temoignage->note_commentaire > $i)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                        @php $i++; @endphp
                        @endforeach
                    </div>
                    <!-- Flèche contrôle témoignange -->
                    <a class="left carousel-control" href="#carouse3-example-generic" role="button" data-slide="prev">
                        <span class="slider-mover-left t-slider-l" aria-hidden="true">
                            <i class="fa fa-angle-left"></i>
                        </span>
                        <span class="sr-only">{{ __('pagination.previous') }}</span>
                    </a>
                    <a class="right carousel-control" href="#carouse3-example-generic" role="button" data-slide="next">
                        <span class="slider-mover-right t-slider-r" aria-hidden="true">
                            <i class="fa fa-angle-right"></i>
                        </span>
                        <span class="sr-only">{{ __('pagination.next') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Fin témoignages -->
<div class="clearfix"></div>
@endsection
@section('script')
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
