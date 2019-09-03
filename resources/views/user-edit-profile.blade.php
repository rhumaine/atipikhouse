@extends('layouts.app')
@section('content')


<!-- Bannière -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>{{ __('profile.edit_my_profile') }}</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{ route('accueil') }}">{{ __('general.home') }}</a></li>
                    <li class="active">{{ __('profile.edit_my_profile') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="content-area my-profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                @include('include.account')
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="submit-address">
                    <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @if ($errors->has('prenom')) has-error @endif">
                                    <label>{!! __('general.first_name') !!}</label>
                                    <input type="text" class="input-text" name="prenom" value="{{Auth::user()->prenom_user}}">
                                    <span class="help-block">@if ($errors->has('prenom'))  {{ $errors->first('prenom')}} @endif</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @if ($errors->has('nom')) has-error @endif">
                                <label>{!! __('general.name') !!}</label>
                                <input type="text" class="input-text" name="nom" value="{{Auth::user()->nom_user}}">
                                <span class="help-block">@if ($errors->has('nom'))  {{ $errors->first('nom')}} @endif</span>
                            </div>
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('email')) has-error @endif">
                            <label>Email</label>
                            <input type="email" class="input-text" name="email" value="{{Auth::user()->email}}">
                            <span class="help-block">@if ($errors->has('email'))  {{ $errors->first('email')}} @endif</span>
                        </div>
                        <div class="form-group @if ($errors->has('description')) has-error @endif">
                            <label>Description</label>
                            <textarea class="input-text" name="description" style="resize: none;">{{Auth::user()->description_fr_user}}</textarea>
                            <span class="help-block">@if ($errors->has('description'))  {{ $errors->first('description')}} @endif</span>
                        </div>
                        <div class="form-group @if ($errors->has('dateNaissance')) has-error @endif">
                            <label>{!! __('general.birthdate') !!}</label>
                            <input type="date" class="input-text" name="dateNaissance" value="{{ Auth::user()->date_de_naissance }}">
                            <span class="help-block">@if ($errors->has('dateNaissance'))  {{ $errors->first('dateNaissance')}} @endif</span>
                        </div>
                        <div class="form-group @if ($errors->has('tel')) has-error @endif">
                            <label>{!! __('general.phone_number') !!}</label>
                            <input type="tel" class="input-text" name="tel" value="{{ Auth::user()->telephone_user }}">
                            <span class="help-block">@if ($errors->has('tel'))  {{ $errors->first('tel')}} @endif</span>
                        </div>
                        <div class="form-group @if ($errors->has('adresse')) has-error @endif">
                            <label>{!! __('general.adress') !!}</label>
                            <input type="text" class="input-text" name="adresse" value="{{ Auth::user()->adresse_user }}">
                            <span class="help-block">@if ($errors->has('adresse'))  {{ $errors->first('adresse')}} @endif</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @if ($errors->has('cp')) has-error @endif">
                                    <label>{!! __('general.postal_code') !!}</label>
                                    <input type="text" class="input-text" name="cp" value="{{ Auth::user()->code_postal_user }}">
                                    <span class="help-block">@if ($errors->has('cp'))  {{ $errors->first('cp')}} @endif</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @if ($errors->has('ville')) has-error @endif">
                                    <label>{!! __('general.ville') !!}</label>
                                    <input type="text" class="input-text" name="ville" value="{{ Auth::user()->ville_user }}">
                                    <span class="help-block">@if ($errors->has('ville'))  {{ $errors->first('ville')}} @endif</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">{!! __('profile.photo_profil') !!}</label>
                            <img src="{{ Auth::user()->avatar }}" style="display:block" class="mb-10">
                            <input type="file" name="images">
                        </div>


                        <button type="submit" class="btn button-md button-theme">{!! __('general.save') !!}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

@endsection
