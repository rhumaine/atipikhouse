@extends('layouts.app')
@section('content')

<div class="properties-details-page content-area">
    <div class="container">
        <div class="row mb-50">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="properties-description mb-40">
                    <div class="main-title-2">
                        <h1><span>{!! __('general.recap_habitat') !!}</span></h1>
                    </div>
                    <div class="properties-description mb-30">
                        <h4>{{ __('general.location') }}</h4>
                        <p class="mb-0">{{ $detailHabitat['adresse_habitat'] }}</p>
                        <p class="mb-0">{{ $detailHabitat['code_postal_habitat'] }}</p>
                        <p class="mb-0">{{ strtoupper($detailHabitat['ville_habitat']) }}</p>
                    </div>
                    <div class="properties-description mb-30">
                        <h4>Description</h4>
                        <p>
                            @if(app()->getLocale() == "fr")
                                {{ $detailHabitat['description_fr_habitat'] }}
                            @else
                                 {{ $detailHabitat['description_en_habitat'] }}
                            @endif
                        </p>
                    </div>
                    <div class="properties-condition mb-30">
                        <h4>{{ __('general.amenities') }}</h4>
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
                   <div class="properties-info-sup mb-30">
                        <h4>{!! __('general.more_infos') !!}</h4>
                        <ul class="list-1">
                            <li>{{ $detailHabitat['capacite_habitat'] }} {!! __('general.person') !!} maximum</li>
                            <li>{{ $detailHabitat['nb_lit_simple_habitat'] }} {!! __('general.beds_simple') !!}</li>
                            <li>{{ $detailHabitat['nb_lit_double_habitat'] }} {!! __('general.beds_double') !!}</li>
                            <li>
                               @if($detailHabitat['fumeur_habitat'] == 0)
                                    {!! __('general.non_smoker') !!}
                                @else
                                    {!! __('general.smoker') !!}
                                @endif
                            </li>
                        </ul>
                        <p>{!! __('general.remise_cles') !!} {{ $heureArrivee }} : {{$minuteArrivee}}
                        </p>
                   </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="sidebar-widget helping-box clearfix">
                    <div class="main-title-2" style="margin-bottom:0">
                        <h1>{!! __('general.your_resa') !!}</h1>
                        <div class="recap_resa">
                            <p>Date d'arrivée : {{ $date_start }}</p>
                            <p>Date de départ : {{ $date_end }}</p>
                            <p>Prix par nuit : {{ $dispoHabitat[0]['prix_disponibilites'] }}
                                    @if(app()->getLocale() == "en")
                                        £
                                    @else
                                        €
                                    @endif</p>
                            <p>Nombre de nuits : {{ $nbJours }}</p>
                            <h3>Total : {{ $prixTotal }}
                                    @if(app()->getLocale() == "en")
                                        £
                                    @else
                                        €
                                    @endif
                            </h3>
                            <form method="POST" id="payment-form"  action="{{ route('reservation.paypalPaiement') }}">
                              {{ csrf_field() }}

                              <input name="amount" type="hidden" value="{{ $prixTotal }}">
                              <input name="devise" type="hidden" value="{{ $dispoHabitat[0]['devise_prix_disponibilites'] }}">
                              <button class="search-button">Payer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
