<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Reservation;
use App\Http\Transformers\ReservationTransformer;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class ReservationController extends Controller
{
    use Helpers;

    //fonction pour récupérer les réservations d'un utilisateur
    public function recapitulatif()
    {
        return $this->response->item(Reservation::recapitulatif(Auth::user()->id), new ReservationTransformer);
    }

    //fonction pour récupérer les réservations d'un habitat
    public function getResa($idHabitat){
        $resaHabitat = Reservation::getResaHabitat($idHabitat);
        return ($resaHabitat);
    }

}
