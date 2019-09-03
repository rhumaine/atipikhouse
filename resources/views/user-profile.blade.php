@extends('layouts.app')
@section('content')


<!-- bannière -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>{{ __('profile.my_profile') }}</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{ route('accueil') }}">{{ __('general.home') }}</a></li>
                    <li class="active">{{ __('profile.my_profile') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- fin bannière -->

<div class="content-area my-profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                @include('include.account')
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="submit-address">
                    <dl class="dl-horizontal">
                      <dt>{!! __('general.pseudo') !!}</dt>
                      <dd>{{Auth::user()->name}}</dd>
                      <dt>{!! __('general.name') !!}</dt>
                      <dd>{{Auth::user()->nom_user}}</dd>
                      <dt>{!! __('general.first_name') !!}</dt>
                      <dd>{{Auth::user()->prenom_user}}</dd>
                      <dt>Email</dt>
                      <dd>{{Auth::user()->email}}</dd>
                      <dt>Description</dt>
                      <dd>{{Auth::user()->description_fr_user}}</dd>
                      <dt>{!! __('general.phone_number') !!}</dt>
                      <dd>{{Auth::user()->telephone_user}}</dd>
                      <?php
                        if(!empty(Auth::user()->date_de_naissance)){
                            list($year, $month, $day) = explode("-", Auth::user()->date_de_naissance);
                            $months = array("janvier", "février", "mars", "avril", "mai", "juin","juillet", "août", "septembre", "octobre", "novembre", "décembre");
                            $date_naissance = $day." ".$months[$month-1]." ".$year;
                        }else{
                            $date_naissance = "";
                        }
                    ?>
                      <dt>{!! __('general.birthdate') !!}</dt>
                      <dd>{{ $date_naissance }}</dd>
                      <dt>{!! __('general.adress') !!}</dt>
                      <dd>{{Auth::user()->adresse_user}}</dd>
                      <dt>{!! __('general.postal_code') !!}</dt>
                      <dd>{{Auth::user()->code_postal_user}}</dd>
                      <dt>{!! __('general.ville') !!}</dt>
                      <dd>{{Auth::user()->ville_user}}</dd>
                    </dl>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

@endsection
