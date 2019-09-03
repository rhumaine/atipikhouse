@extends('layouts.app')
@section('content')

<!-- bannière -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>{{ __('general.edit_act') }}</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{ route('accueil') }}">{{ __('general.accueil') }}</a></li>
                    <li class="active">{{ __('general.edit_act') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- fin bannière -->

<div class="content-area-7 submit-property">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                @include('include.account')
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="submit-address">
                    <form id="formAddActivite" method="POST" action="{{ route('activite.update', $detailActivite['id_activites']) }}" enctype="multipart/form-data">
                       @csrf
                        <div class="main-title-2">
                            <h1><span>{{ __('general.info_base') }}</span></h1>
                        </div>
                        <div class="search-contents-sidebar mb-30">

                            <div class="form-group @if ($errors->has('titre')) has-error @endif">
                                <label class="control-label">{{ __('general.titre') }}</label>
                                <input type="text" class="input-text" name="titre" placeholder="{{ __('general.titre') }}" value="{{ $detailActivite['libelle_fr_activites'] }}" autofocus>
                                <span class="help-block">@if ($errors->has('titre'))  {{ $errors->first('titre')}} @endif</span>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <label class="control-label">{{ __('general.price') }}</label>
                                    <input type="number" class="input-text" name="prix" step="0.1" placeholder="{{ __('general.price') }}" value="{{ $detailActivite['prix_activites'] }}" autofocus>
                                    <span class="help-block">@if ($errors->has('prix'))  {{ $errors->first('prix')}} @endif</span>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group @if ($errors->has('devise')) has-error @endif">
                                        <label class="control-label">{{ __('general.devise') }}</label>
                                        <select class="selectpicker search-fields" name="devise">
                                            <option disabled> -- {!! __('general.devise') !!} -- </option>
                                            <option value="EUR" @if($detailActivite['devise_prix_activites'] == "EUR") selected @endif>€</option>
                                            <option value="GBP" @if($detailActivite['devise_prix_activites'] == "GBP") selected @endif>£</option>
                                        </select>
                                        <span class="help-block">@if ($errors->has('devise'))  {{ $errors->first('devise')}} @endif</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="control-label">Places</label>
                                    <input type="number" class="input-text" name="places" step="1" placeholder="Places" value="{{ $detailActivite['nb_places_activites'] }}" autofocus>
                                    <span class="help-block">@if ($errors->has('places'))  {{ $errors->first('places')}} @endif</span>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="control-label">{{ __('general.phone_number') }}</label>
                                    <input type="text" class="input-text" name="telephone" placeholder="{{ __('general.phone_number') }}" value="{{ $detailActivite['telephone_activites'] }}" autofocus>
                                    <span class="help-block">@if ($errors->has('telephone'))  {{ $errors->first('telephone')}} @endif</span>
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                <label class="control-label">{{ __('general.description') }}</label>
                                <textarea class="form-control rounded-0" rows="3" name="description">{{ $detailActivite['description_activites'] }}</textarea>
                                <span class="help-block">@if ($errors->has('description'))  {{ $errors->first('description')}} @endif</span>
                            </div>

                            <div class="main-title-2">
                                <h1><span>{{ __('general.location') }}</span></h1>
                            </div>

                            <div class="row mb-30">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group @if ($errors->has('adresse')) has-error @endif">
                                        <label class="control-label">{{ __('general.adress') }}</label>
                                        <input type="text" class="input-text" name="adresse" value="{{ $detailActivite['adresse_activites'] }}" placeholder="{{ __('general.adress') }}">
                                        <span class="help-block">@if ($errors->has('adresse'))  {{ $errors->first('adresse')}} @endif</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group @if ($errors->has('code_postal')) has-error @endif">
                                        <label class="control-label">{{ __('general.CP') }}</label>
                                        <input type="number" class="input-text" name="code_postal" value="{{ $detailActivite['code_postal_activites'] }}" placeholder="{{ __('general.CP') }}">
                                        <span class="help-block">@if ($errors->has('code_postal'))  {{ $errors->first('code_postal')}} @endif</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group @if ($errors->has('ville')) has-error @endif">
                                        <label class="control-label">{{ __('general.ville') }}</label>
                                        <input type="text" class="input-text" name="ville" value="{{ $detailActivite['ville_activites'] }}" placeholder="{{ __('general.ville') }}">
                                        <span class="help-block">@if ($errors->has('ville'))  {{ $errors->first('ville')}} @endif</span>
                                    </div>
                                </div>

                                <div class="main-title-2">
                                    <h1><span>{{ __('general.my_hebergements') }}</span></h1>
                                </div>

                                <p>{{ __('general.act_hab') }}</p>

                                @foreach($habitats as $hab)
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="habitats[]" id="checkhabitats" value="{{$hab->id_habitat}}" @if(in_array($hab->id_habitat, $tabHabitat)) checked @endif>
                                      <label class="form-check-label" for="checkhabitats">
                                        {{$hab->titre_habitat}}
                                      </label>
                                    </div>
                                @endforeach


                                <input id="inputLatitude" type="hidden" name="latitude">
                                <input id="inputLongitude" type="hidden" name="longitude">


                                <div class="row">
                                    <div class="col-md-12">
                                      <input type="button" onclick="enregistrer()" class="btn button-md button-theme pull-right" value="{!! __('general.save') !!}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    /*============== récupération latitude et longitude du lieu de l'activité ==================*/
    var geocoder = new google.maps.Geocoder();

    function geocode_callback(results, status) {

          if (status == google.maps.GeocoderStatus.OK) {
                // results[0].geometry.location est un objet de type LatLng (une position)
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();

                $('#inputLatitude').val(latitude);
                $('#inputLongitude').val(longitude);


                $("#formAddActivite").submit();

          } else {

                alert("L'adresse n'a pas été trouvé");
          }
    }

    function enregistrer(){

        var adresse = $('input[name="adresse"]').val();
        var ville = $('input[name="ville"]').val();
        var codePostal = $('input[name="code_postal"]').val();

        var adresse = adresse + " " + codePostal + " " + ville;

        geocoder.geocode(
            {'address': adresse},geocode_callback
        );
    }



</script>

@endsection
