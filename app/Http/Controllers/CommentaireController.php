<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Commentaires;
use App\Models\Reservation;
use Dingo\Api\Routing\Helpers;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
//use Dingo\Api\Facade\Route;


class CommentaireController extends Controller{

    use Helpers;

    //fonction pour poster un commentaire
    public function poster(Request $request){


        $validatedData = $request->validate([
            'note' => 'required',
            'commentaire' => 'required',
            'id_habitat' => 'required'
        ]);

        //check si une reservation passé existe pour le couple user/habitat et pas
        $boolReservation = Reservation::getReservationCommentaireByHabitat($validatedData['id_habitat'], Auth::user()->id);


        if(isset($boolReservation[0])){

            $data = Reservation::checkReservationCommentaireByHabitat($validatedData['id_habitat'], Auth::user()->id);

            if(empty($data)){
                Commentaires::addCommentairesByHabitat($validatedData, $boolReservation[0]->id_reservations);
            }else{
                return redirect()->route('detailhabitat', ['id' => $validatedData['id_habitat']]);
            }
        }

        return redirect()->route('detailhabitat', ['id' => $validatedData['id_habitat']]);

    }
}







