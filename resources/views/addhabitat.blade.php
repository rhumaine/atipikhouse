@extends('layouts.app')
@section('content')
<!-- Bannière -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>{{ __('general.add_hab') }}</h1>
                <ul class="breadcrumbs">
                    <li><a href="index.html">{{ __('general.home') }}</a></li>
                    <li class="active">{{ __('general.add_hab') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Fin bannière -->

<!-- Contenu ajout habitat -->
<div class="content-area my-profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                @include('include.account')
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="submit-address">
                    <form id="formAddHabitat" method="POST" action="{{ route('habitat.store') }}" enctype="multipart/form-data">
                       @csrf
                        <div class="main-title-2">
                            <h1><span>{{ __('general.info_base') }}</span></h1>
                        </div>
                        <div class="search-contents-sidebar mb-30">
                            <div class="form-group @if ($errors->has('titre')) has-error @endif">
                                <label class="control-label">{{ __('general.titre') }}</label>
                                <input type="text" class="input-text" name="titre" placeholder="{{ __('general.titre') }}" value="{{ old('titre') }}" autofocus>
                                <span class="help-block">@if ($errors->has('titre'))  {{ $errors->first('titre')}} @endif</span>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group @if ($errors->has('typeHabitat')) has-error @endif">
                                        <label class="control-label">{{ __('general.type') }}</label>
                                        <select id="selectTypeBien" class="selectpicker search-fields" name="typeHabitat">
                                          <option disabled selected> -- sélectionner -- </option>
                                           @foreach($typesHabitat as $type)
                                                <option @if(old('typeHabitat') == $type['id_types_bien']) selected @endif value="{{ $type['id_types_bien'] }}">{{ $type['libelle_fr_types_bien'] }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">@if ($errors->has('typeHabitat'))  {{ $errors->first('typeHabitat')}} @endif</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group @if ($errors->has('superficie')) has-error @endif">
                                        <label class="control-label">{{ __('general.superficie') }}</label>
                                        <input type="number" class="input-text" name="superficie" value="{{ old('superficie') }}" placeholder="{{ __('general.superficie') }}">
                                        <span class="help-block">@if ($errors->has('superficie'))  {{ $errors->first('superficie')}} @endif</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group @if ($errors->has('capacite')) has-error @endif">
                                        <label class="control-label">{{ __('general.capacite') }}</label>
                                        <select class="selectpicker search-fields" name="capacite">
                                            <option disabled selected> -- {!! __('general.select') !!} -- </option>
                                            <option @if(old('capacite') == 1) selected @endif>1</option>
                                            <option @if(old('capacite') == 2) selected @endif>2</option>
                                            <option @if(old('capacite') == 3) selected @endif>3</option>
                                            <option @if(old('capacite') == 4) selected @endif>4</option>
                                            <option @if(old('capacite') == 5) selected @endif>5</option>
                                            <option @if(old('capacite') == 6) selected @endif>6</option>
                                            <option @if(old('capacite') == 7) selected @endif>7</option>
                                            <option @if(old('capacite') == 8) selected @endif>8</option>
                                            <option @if(old('capacite') == 9) selected @endif>9</option>
                                            <option @if(old('capacite') == 10) selected @endif>10</option>
                                        </select>
                                        <span class="help-block">@if ($errors->has('capacite'))  {{ $errors->first('capacite')}} @endif</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group @if ($errors->has('nbLitSimple')) has-error @endif">
                                        <label class="control-label">{{ __('general.lit_simple') }}</label>
                                        <select class="selectpicker search-fields" name="nbLitSimple">
                                            <option disabled selected> -- {!! __('general.select') !!} -- </option>
                                            <option @if(old('nbLitSimple') == 0) selected @endif>0</option>
                                            <option @if(old('nbLitSimple') == 1) selected @endif>1</option>
                                            <option @if(old('nbLitSimple') == 2) selected @endif>2</option>
                                            <option @if(old('nbLitSimple') == 3) selected @endif>3</option>
                                            <option @if(old('nbLitSimple') == 4) selected @endif>4</option>
                                            <option @if(old('nbLitSimple') == 5) selected @endif>5</option>
                                            <option @if(old('nbLitSimple') == 6) selected @endif>6</option>
                                        </select>
                                        <span class="help-block">@if ($errors->has('nbLitSimple'))  {{ $errors->first('nbLitSimple')}} @endif</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group @if ($errors->has('nbLitDouble')) has-error @endif">
                                        <label class="control-label">{{ __('general.lit_double') }}</label>
                                        <select class="selectpicker search-fields" name="nbLitDouble">
                                            <option disabled selected> -- {!! __('general.select') !!} -- </option>
                                            <option @if(old('nbLitDouble') == 0) selected @endif>0</option>
                                            <option @if(old('nbLitDouble') == 1) selected @endif>1</option>
                                            <option @if(old('nbLitDouble') == 2) selected @endif>2</option>
                                            <option @if(old('nbLitDouble') == 3) selected @endif>3</option>
                                            <option @if(old('nbLitDouble') == 4) selected @endif>4</option>
                                            <option @if(old('nbLitDouble') == 5) selected @endif>5</option>
                                            <option @if(old('nbLitDouble') == 6) selected @endif>6</option>
                                        </select>
                                        <span class="help-block">@if ($errors->has('nbLitDouble'))  {{ $errors->first('nbLitDouble')}} @endif</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group @if ($errors->has('heureArrivee')) has-error @endif">
                                        <label class="control-label">{{ __('general.heure_arrivee') }}</label>
                                        <select class="selectpicker search-fields" name="heureArrivee">
                                            <option disabled selected> -- {!! __('general.select') !!} -- </option>
                                            <option @if(old('heureArrivee') == '14:00') selected @endif>14:00</option>
                                            <option @if(old('heureArrivee') == '14:00') selected @endif>15:00</option>
                                            <option @if(old('heureArrivee') == '14:00') selected @endif>16:00</option>
                                        </select>
                                        <span class="help-block">@if ($errors->has('heureArrivee'))  {{ $errors->first('heureArrivee')}} @endif</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                            <div id="champSupp">


                            </div>

                            </div>
                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                <label class="control-label">{{ __('general.desc_FR') }}</label>
                                    <textarea name="description" class="input-text search-fields" placeholder="{{ __('general.desc_FR') }}">{{ old('description') }}</textarea>
                                    <span class="help-block">@if ($errors->has('description'))  {{ $errors->first('description')}} @endif</span>
                                </div>
                            </div>


                        <div class="main-title-2">
                            <h1><span>{{ __('general.gallerie_habitat') }}</span></h1>
                        </div>
                        <input type="file" name="images[]" multiple>
                        <span class="help-block" style="color:red">@if ($errors->has('images'))  {{ $errors->first('images')}} @endif</span>
                        <br/><br/>
                        <div class="main-title-2">
                            <h1><span>{{ __('general.location') }}</span></h1>
                        </div>
                        <div class="row mb-30">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group @if ($errors->has('adresse')) has-error @endif">
                                    <label class="control-label">{{ __('general.adress') }}</label>
                                    <input type="text" class="input-text" name="adresse" value="{{ old('adresse') }}" placeholder="{{ __('general.adress') }}">
                                    <span class="help-block">@if ($errors->has('adresse'))  {{ $errors->first('adresse')}} @endif</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group @if ($errors->has('code_postal')) has-error @endif">
                                    <label class="control-label">{{ __('general.CP') }}</label>
                                    <input type="number" class="input-text" name="code_postal" value="{{ old('code_postal') }}" placeholder="{{ __('general.CP') }}">
                                    <span class="help-block">@if ($errors->has('code_postal'))  {{ $errors->first('code_postal')}} @endif</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group @if ($errors->has('ville')) has-error @endif">
                                    <label class="control-label">{{ __('general.ville') }}</label>
                                    <input type="text" class="input-text" name="ville" value="{{ old('ville') }}" placeholder="{{ __('general.ville') }}">
                                    <span class="help-block">@if ($errors->has('ville'))  {{ $errors->first('ville')}} @endif</span>
                                </div>
                            </div>

                            <input id="inputLatitude" type="hidden" name="latitude">
                            <input id="inputLongitude" type="hidden" name="longitude">

                        </div>

                        <div class="main-title-2">
                            <h1><span>{{ __('general.info_detaillees') }}</span></h1>
                        </div>

                        <div class="mb-30">
                            <div class="form-group @if ($errors->has('reglement')) has-error @endif">
                                <label class="control-label">{{ __('general.reg_FR') }}</label>
                                <textarea class="input-text" name="reglement" placeholder="{{ __('general.reg_FR') }}">{{ old('reglement') }}</textarea>
                                <span class="help-block">@if ($errors->has('reglement'))  {{ $errors->first('reglement')}} @endif</span>
                            </div>
                        </div>
                        <div class="row mb-30">

                            <div class="col-lg-12">
                                <label class="margin-t-10">{!! __('general.equipment') !!} ({!! __('general.optional') !!})</label>
                                <div class="row">
                                       @foreach($allEquipements as $equipement)
                                           @if(app()->getLocale() == "fr")
                                                <div class="col-lg-3 col-sm-4 col-xs-6">
                                                    <div class="checkbox checkbox-theme checkbox-circle">
                                                        <input id="checkbox{{ $equipement['id_types_equipement'] }}" type="checkbox" name="equipements[]" value="{{ $equipement['id_types_equipement'] }}" @if(is_array(old('equipements')) && in_array($equipement['id_types_equipement'], old('equipements'))) checked @endif>
                                                        <label for="checkbox{{ $equipement['id_types_equipement'] }}">
                                                            {{ $equipement['libelle_fr_types_equipement'] }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-lg-3 col-sm-4 col-xs-6">
                                                    <div class="checkbox checkbox-theme checkbox-circle">
                                                        <input id="checkbox{{ $equipement['id_types_equipement'] }}" type="checkbox" name="equipements[]" value="{{ $equipement['id_types_equipement'] }}" @if(is_array(old('equipements')) && in_array($equipement['id_types_equipement'], old('equipements'))) checked @endif>
                                                        <label for="checkbox{{ $equipement['id_types_equipement'] }}">
                                                            {{ $equipement['libelle_en_types_equipement'] }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                       @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              <input type="button" onclick="enregistrer()" class="btn button-md button-theme pull-right" value="{!! __('general.save') !!}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin contenu ajout habitat -->

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


                $("#formAddHabitat").submit();

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

    $( "#selectTypeBien" ).change(function() {
        var idTypeBien = $('#selectTypeBien').val();

        $.ajax({

            url : "/atypikhouse/habitat/getChamps/"+idTypeBien,
            type : "GET",
            success : function(html){
                $('#champSupp').html(html);
            }
        });
    });
</script>
@endsection
