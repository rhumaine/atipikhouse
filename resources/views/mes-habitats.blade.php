@extends('layouts.app')
@section('content')
<!-- bannière -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>{!! __('general.my_hebergements') !!}</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{ route('accueil') }}">{!! __('general.accueil') !!}</a></li>
                    <li class="active">{!! __('general.my_hebergements') !!}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- fin bannière -->

<div class="content-area-7 my-properties">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                @include('include.account')
            </div>

             <div class="col-lg-8 col-md-8 col-sm-12">
                <table class="manage-table responsive-table">
                    <tbody>

                    @foreach($listeHabitats as $habitat)
                    <tr>
                        <td class="title-container">
                           @if (!empty($habitat->url_photos_habitation))
                                <img src="{{ asset('public/img/photos/habitats/vignettes/'.$habitat->url_photos_habitation) }}" alt="my-properties-1" class="img-responsive hidden-xs">
                            @else
                                <img src="{{ asset('public/img/photos/habitats/vignettes/default.jpg') }}" alt="my-properties-1" class="img-responsive hidden-xs">
                            @endif

                            <div class="title" style="min-height: 110px;">
                                <h4><a href="{{ route('detailhabitat', $habitat->id_habitat)}}">{{$habitat->titre_habitat}} </a></h4>
                                <span><i class="fa fa-map-marker"></i>{{$habitat->adresse_habitat.", ".$habitat->code_postal_habitat.", ".$habitat->ville_habitat }}</span>
                            </div>
                        </td>
                        <?php
                            if(isset($habitat->created_at)){
                                list($year, $month, $day) = explode("-", $habitat->created_at);
                                $months = array("janvier", "février", "mars", "avril", "mai", "juin","juillet", "août", "septembre", "octobre", "novembre", "décembre");
                                list($day, $time) = explode(" ", $day);
                                $date_creation = $day." ".$months[$month-1]." ".$year;
                            }

                        ?>
                        <td class="expire-date hidden-xs">{{ $date_creation }}</td>
                        <td class="action">
                            <a href="{{ route('habitat.getdispo', $habitat->id_habitat) }}"><i class="fa fa-calendar"></i> Disponibilités</a>
                            <a href="#" data-toggle="modal" data-target="#modalPlanning" data-id="{{ $habitat->id_habitat }}"><i class="fa fa-calendar"></i> Planning</a>
                            <a href="{{ route('habitat.modify', $habitat->id_habitat) }}"><i class="fa fa-pencil"></i> {!! __('general.modify') !!}</a>
                            <a href="#" class="delete"><i class="fa fa-remove"></i> {!! __('general.delete') !!}</a>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPlanning" tabindex="-1" role="dialog" aria-labelledby="modalPlanningLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalPlanningLabel">Planning</h4>
      </div>
        <div class="modal-body">
            <div class="form-group">
               <input type="text" class="input-text" name="daterange" value=""/>
            </div>
        </div>
        <div id="divrange"></div>
    </div>
  </div>
</div>

@endsection
@section('script')

   <script>

        $('#modalPlanning').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var today = new Date();

            $.getJSON('/atypikhouse/api/reservation/'+id, function( data ) {
                 let dateRanges = data ;

                $('input[name="daterange"]').daterangepicker({
                    opens: 'center',
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

                    "parentEl": "#divrange",

                    isInvalidDate: function(date) {

                        return dateRanges.reduce(function(bool, range) {
                            return bool || (date >= moment(range.start) && date <= moment(range.end));
                        }, false);

                      }
                    }
                );
            });
        });
    </script>
@endsection
