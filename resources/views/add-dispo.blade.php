@extends('layouts.app')
@section('content')
<!-- Bannière -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>{{ __('general.add_dispo') }}</h1>
                <ul class="breadcrumbs">
                    <li><a href="index.html">{{ __('general.home') }}</a></li>
                    <li class="active">{{ __('general.add_dispo') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Fin bannière -->

<!--Contenu ajout dispo -->
<div class="content-area my-profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                @include('include.account')
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="submit-address">
                    <form id="formAddDispo" method="POST" action="{{ route('habitat.dispoAdd') }}" enctype="multipart/form-data">
                       @csrf
                        <div class="main-title-2">
                            <h1><span>{{ __('general.info_base') }}</span></h1>
                        </div>
                        <div class="search-contents-sidebar mb-30">

                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group @if ($errors->has('dateDebut')) has-error @endif">
                                        <label class="control-label">{{ __('general.dateDebut') }}</label>
                                        <input type="text"  class="input-text" name="dateDebut" id="dateDebut">
                                        <span class="help-block">@if ($errors->has('dateDebut'))  {{ $errors->first('dateDebut')}} @endif</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group @if ($errors->has('dateFin')) has-error @endif">
                                        <label class="control-label">{{ __('general.dateFin') }}</label>
                                        <input type="text" class="input-text"  name="dateFin" id="dateFin">
                                        <span class="help-block">@if ($errors->has('dateFin'))  {{ $errors->first('dateFin')}} @endif</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group  @if ($errors->has('prixDispo')) has-error @endif">
                                        <label class="control-label">{{ __('general.price') }}</label>
                                        <input type="number" class="input-text" name="prixDispo" id="prixDispo" placeholder="Indiquez un prix">
                                        <span class="help-block">@if ($errors->has('prixDispo'))  {{ $errors->first('prixDispo')}} @endif</span>
                                    </div>
                                </div>
                                 <div class="col-md-4 col-sm-6">
                                    <div class="form-group  @if ($errors->has('deviseDispo')) has-error @endif">
                                        <label class="control-label">{{ __('general.devise') }}</label>
                                        <select class="selectpicker search-fields" name="devise">
                                            <option disabled selected> -- {!! __('general.devise') !!} -- </option>
                                            <option value="EUR">€</option>
                                            <option value="GBP">£</option>
                                        </select>
                                        <span class="help-block">@if ($errors->has('deviseDispo'))  {{ $errors->first('deviseDispo')}} @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                             <input type="hidden" name="idHabitat" value="{{ $detailHabitat['id_habitat'] }}">
                              <input type="button" id="buttonSubmit" class="btn button-md button-theme pull-right" value="{!! __('general.save') !!}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin contenu -->
@endsection

@section('script')
<script>

    $(function() {
        $('input[name="dateDebut"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
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
            }
            }
        );

        $('input[name="dateFin"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
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
            }
        });
    });



    $('#buttonSubmit').on('click', function(e){
        e.preventDefault;
        $('#formAddDispo').submit();
    });

</script>

@endsection
