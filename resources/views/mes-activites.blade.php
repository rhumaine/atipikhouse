@extends('layouts.app')
@section('content')



<!-- bannière -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>{!! __('general.my_activities') !!}</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{ route('accueil') }}">{!! __('general.accueil') !!}</a></li>
                    <li class="active">{!! __('general.my_activities') !!}</li>
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
                 <div class="main-title-2">
                     <h1>{!! __('general.my_activites_title') !!}</h1>
                 </div>
                <table class="manage-table responsive-table">
                    <tbody>

                    @foreach($listeActivites as $activite)
                    <tr>
                        <td class="title-container">
                            <div class="title">
                                <h4><a href="{{ route('detailactivite', $activite->id_activites)}}">{{$activite->libelle_fr_activites}} </a></h4>
                                <span><i class="fa fa-map-marker"></i>{{$activite->adresse_activites.", ".$activite->code_postal_activites.", ".$activite->ville_activites }}</span>
                            </div>
                        </td>
                        <?php
                            if(isset($activite->created_at)){
                                list($year, $month, $day) = explode("-", $activite->created_at);
                                $months = array("janvier", "février", "mars", "avril", "mai", "juin","juillet", "août", "septembre", "octobre", "novembre", "décembre");
                                list($day, $time) = explode(" ", $day);
                                $date_creation = $day." ".$months[$month-1]." ".$year;
                            }

                        ?>
                        <td class="expire-date hidden-xs">{{ $date_creation }}</td>
                        <td class="action">
                            <a href="{{ route('activite.modify', $activite->id_activites) }}"><i class="fa fa-pencil"></i> {!! __('general.modify') !!}</a>
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

@endsection
