@extends('layouts.app')
@section('content')



<!-- bannière -->
<div class="sub-banner overview-bgi">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>{!! __('general.awaiting_resa') !!}</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{ route('accueil') }}">{!! __('general.accueil') !!}</a></li>
                    <li class="active">{!! __('general.awaiting_resa') !!}</li>
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
                    <thead>
                        <tr>
                            <th>{!! __('general.heb') !!}</th>
                            <th>Date</th>
                            <th>{!! __('general.price') !!}</th>
                            <th>{!! __('general.etat') !!}</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($reservationsAttentes as $reservation)
                        <tr>
                            <td>
                                <a href="{{ route('detailhabitat', $reservation->id_habitat)}}">{{$reservation->titre_habitat}}</a>
                            </td>
                            <td>
                                {{date('d/m/Y', strtotime($reservation->date_debut_reservation))}} {!! __('general.to') !!} {{date('d/m/Y', strtotime($reservation->date_fin_reservation))}}
                            </td>
                            <td>
                                {{$reservation->prix}}€
                            </td>
                            <td>
                                {{$reservation->libelle_statut_resa}}
                            </td>
                            <td class="action">
                                <a href="{{route('reservation.accepte', $reservation->id_reservations)}}"><i class="fa fa-check"></i> {!! __('general.accept') !!}</a>
                                <a href="{{route('reservation.refus', $reservation->id_reservations)}}"><i class="fa fa-remove"></i> {!! __('general.refuse') !!}</a>
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
