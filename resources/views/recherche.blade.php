@extends('layouts.app')
@section('content')

<div class="map-content content-area container-fluid">
    <div class="col-xs-12 col-sm-12 col-md-5 col-md-push-7 col-lg-6 col-lg-push-6">
        <div class="row">
            <div id="map"></div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-7 col-md-pull-5 col-lg-6 col-lg-pull-6 map-content-sidebar">
        <div class="title-area">
            <h2 class="pull-left">{!! __('general.search') !!}</h2>
            <a  class="show-more-options pull-right" data-toggle="collapse" data-target="#options-content">
                <i class="fa fa-plus-circle"></i> {!! __('general.show_more') !!}
            </a>
            <div class="clearfix"></div>
        </div>
        <div class="properties-map-search">
            <div class="properties-map-search-content">
                <form id="formRecherche" action="{{ route('recherche') }}" method="get">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <input id="inputDestination" name="destination" class="form-control search-fields" autocomplete="on" placeholder="Saisissez votre destination" value="@if(isset($_GET['destination'])){{$_GET['destination']}}@endif">
                                <input id="locality" type="hidden" name="ville" value="@if(isset($_GET['ville'])){{$_GET['ville']}}@endif">
                                <input id="country" type="hidden" name="pays" value="@if(isset($_GET['pays'])){{$_GET['pays']}}@endif">
                                <input id="latitude" type="hidden" name="latitude" value="@if(isset($_GET['latitude'])){{$_GET['latitude']}}@endif">
                                <input id="longitude" type="hidden" name="longitude" value="@if(isset($_GET['longitude'])){{$_GET['longitude']}}@endif">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control search-fields" name="daterange" value="@if(isset($_GET['date_start']) && isset($_GET['date_end'])){{$_GET['date_start']." - ".$_GET['date_end']}}@endif" placeholder="Date arrivée - Date départ">
                                <input type="hidden" id="date-start" name="date_start" value="@if(isset($_GET['date_start'])){{$_GET['date_start']}}@endif"/>
                                <input type="hidden" id="date-end" name="date_end" value="@if(isset($_GET['date_end'])){{$_GET['date_end']}}@endif"/>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <select class="selectpicker search-fields"_ name="type_hebergement">
                                    <option value="0">{!! __('general.type_heb') !!}</option>
                                    @foreach($listeTypesHabitat as $type)
                                        <option value="{{ $type->id_types_bien }}" @if(isset($_GET['type_hebergement']) && $_GET['type_hebergement'] == $type->id_types_bien) selected @endif>{{ $type->libelle_fr_types_bien }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <select class="selectpicker search-fields" name="capacite" data-live-search="true" data-live-search-placeholder="Rechercher...">
                                    <option value="0">Capacité</option>
                                    <option value="1" @if(isset($_GET['capacite']) && $_GET['capacite'] == 1) selected @endif>1 {!! __('general.person') !!}</option>
                                    <option value="2" @if(isset($_GET['capacite']) && $_GET['capacite'] == 2) selected @endif>2 {!! __('general.persons') !!}</option>
                                    <option value="3" @if(isset($_GET['capacite']) && $_GET['capacite'] == 3) selected @endif>3 {!! __('general.persons') !!}</option>
                                    <option value="4" @if(isset($_GET['capacite']) && $_GET['capacite'] == 4) selected @endif>4 {!! __('general.persons') !!}</option>
                                    <option value="5" @if(isset($_GET['capacite']) && $_GET['capacite'] == 5) selected @endif>5 {!! __('general.persons') !!}</option>
                                    <option value="6" @if(isset($_GET['capacite']) && $_GET['capacite'] == 6) selected @endif>6 {!! __('general.persons') !!}</option>
                                    <option value="7" @if(isset($_GET['capacite']) && $_GET['capacite'] == 7) selected @endif>7 {!! __('general.persons') !!}</option>
                                    <option value="8" @if(isset($_GET['capacite']) && $_GET['capacite'] == 8) selected @endif>8 {!! __('general.persons') !!}</option>
                                    <option value="9" @if(isset($_GET['capacite']) && $_GET['capacite'] == 9) selected @endif>9 {!! __('general.persons') !!}</option>
                                    <option value="10" @if(isset($_GET['capacite']) && $_GET['capacite'] == 10) selected @endif>10 {!! __('general.persons') !!}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="range-slider">
                                <label>{!! __('general.price') !!}</label>
                                <div data-min="0" data-max="1000" data-unit="€" data-min-name="min_prix" data-max-name="max_prix" class="range-slider-ui ui-slider" aria-disabled="false"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div id="options-content" class="collapse">
                        <label class="margin-t-10">{!! __('general.equipments_obl') !!}</label>
                        <div class="row">
                           @foreach($allEquipements as $equipement)
                               @if(app()->getLocale() == "fr")
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="checkbox checkbox-theme checkbox-circle">
                                            <input id="checkbox{{ $equipement['id_types_equipement'] }}" type="checkbox" name="equipements[]" value="{{ $equipement['id_types_equipement'] }}" @if(isset($_GET['equipements']) && in_array($equipement['id_types_equipement'], $_GET['equipements'])) checked @endif>
                                            <label for="checkbox{{ $equipement['id_types_equipement'] }}">
                                                {{ $equipement['libelle_fr_types_equipement'] }}
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
                    <input id="btnSubmitFormRecherche" type="button" class="button-md button-theme btn-block margin-t-10" value="Rechercher">
                </form>
            </div>
        </div>

        <div class="map-content-separater"></div>
        <div class="clearfix"></div>

        <div class="title-area">
            <h2 class="pull-left">{!! __('general.search_result') !!}</h2>
            <div class="pull-right btns-area">
                <a href="properties-map-leftside-list.html" class="change-view-btn"><i class="fa fa-th-list"></i></a>
                <a href="properties-map-leftside-grid.html" class="change-view-btn active-view-btn"><i class="fa fa-th-large"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="fetching-properties"></div>
    </div>
</div>
@endsection

@section('script')

<script>
    $('#btnSubmitFormRecherche').on('click', function(e){
        e.preventDefault;
        $('#formRecherche').submit();
    });

</script>

<script>
    $(document).ready(function(){
        $(".range-slider-ui").each(function () {

        var unit = $(this).attr('data-unit');
            $(this).slider({
              values: [<?php if(isset($_GET['min_prix'])){ echo $_GET['min_prix']; }else{ echo 0; } ?>, <?php if(isset($_GET['max_prix'])){ echo $_GET['max_prix']; }else{ echo 1000; } ?>]
            });

            $(this).children(".min-value").text( <?php if(isset($_GET['min_prix'])){ echo $_GET['min_prix']; }else{ echo 0; } ?> + " " + unit);
            $(this).children(".max-value").text(<?php if(isset($_GET['max_prix'])){ echo $_GET['max_prix']; }else{ echo 1000; } ?> + " " + unit);
            $(this).children(".current-min").val(<?php if(isset($_GET['min_prix'])){ echo $_GET['min_prix']; }else{ echo 0; } ?>);
            $(this).children(".current-max").val(<?php if(isset($_GET['max_prix'])){ echo $_GET['max_prix']; }else{ echo 1000; } ?>);
        });

        let pansement = '{"data":'+JSON.stringify(<?php echo json_encode($habitats); ?>)+'}';
        var latitude = <?php if(isset($_GET['latitude']) && $_GET['latitude'] != ''){ echo $_GET['latitude']; } ?>;
        var longitude = <?php if(isset($_GET['longitude']) && $_GET['longitude'] != ''){ echo $_GET['longitude']; } ?>;
        var providerName = 'Hydda.Full';
        generateMap(latitude, longitude, providerName, 'grid_layout', JSON.parse(pansement));
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

<script type="text/javascript">
$(function() {

    $('input[name="daterange"]').daterangepicker({
        autoUpdateInput: false,
        minDate: moment(),
        locale: {
            cancelLabel: 'Clear',
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
  },function(start, end, label){
        $('#date-start').val(start.format('DD/MM/YYYY'));
        $('#date-end').val(end.format('DD/MM/YYYY'));
});

  $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
  });

  $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});
</script>
@endsection
