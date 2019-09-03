<?php

namespace App\Http\Transformers;

use App\Models\Reservation;
use League\Fractal\TransformerAbstract;

class ReservationTransformer extends TransformerAbstract
{
    public function transform(Reservation $reservation) : array
    {
        //inutile il semblerait
        /*return [
            'id_reservations' => $reservation->id_reservations,
            'date_debut_reservation' => $reservation->date_debut_reservation,
            'date_fin_reservation' => $reservation->date_fin_reservation,
            'id_user' => $reservation->id_user,
            'id_habitat' => $reservation->id_habitat,
            'id_statut_resa' => $reservation->id_statut_resa,
            'titre_habitat' => $reservation->titre_habitat
        ];*/
    }
}
