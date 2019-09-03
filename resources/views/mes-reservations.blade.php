@extends('layouts.app')
@section('content')



<!-- Bannière -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>{!! __('general.my_resa') !!}</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{ route('accueil') }}">{!! __('general.accueil') !!}</a></li>
                    <li class="active">{!! __('general.my_resa') !!}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Fin bannière -->

<div class="content-area-7 my-properties">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                @include('include.account')
            </div>

             <div class="col-lg-8 col-md-8 col-sm-12">
                <table class="manage-table responsive-table">
                    <thead>
                        <tr>
                            <th>{!! __('general.heb_reserved') !!}</th>
                            <th>{!! __('general.date_sejour') !!}</th>
                            <th>{!! __('general.price') !!}</th>
                            <th>{!! __('general.etat') !!}</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($listeReservations as $reservation)
                        <tr>
                            <td>
                                <a href="{{ route('detailhabitat', $reservation->id_habitat)}}">{{$reservation->titre_habitat}}</a>
                            </td>
                            <td>
                                {{date('d/m/Y', strtotime($reservation->date_debut_reservation))}} au {{date('d/m/Y', strtotime($reservation->date_fin_reservation))}}
                            </td>
                            <td>
                                {{$reservation->prix}}€
                            </td>
                            <td>
                                {{$reservation->libelle_statut_resa}}
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
@section('script')

@endsection
