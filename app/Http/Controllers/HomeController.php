<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitat;
use App\Models\Commentaires;
use App\Models\Reservation;
use App\Models\Entreprise;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    // Fonction pour afficher la page d'accueil et les données utilisées
    public function index(){

        $data['nbLogements'] = Habitat::getNbLogements();
        $data['nbUsers'] = Habitat::getNbUsers();
        $data['nbTypesBien'] = Habitat::getNbTypesBien();
        $data['listeTypesHabitat'] = Habitat::getTypesHabitat();
        $data['listeTemoignages'] = Commentaires::getTemoignages();
        $data['listeDerniersLogements'] = Habitat::getLastHabitat(8);
        $data['entreprise'] = Entreprise::getEntreprise();

        $j=0;
        foreach($data['listeDerniersLogements'] as $h){

            $reservations = Reservation::getResaByHabitat($h->id_habitat);
            $reservations = json_decode($reservations, true);

            $noteComm = 0;
            $i = 0;
            $nbNote = 0;
            foreach($reservations as $r){


                $note = Habitat::getNoteHabitat($r['id_reservations']);

                foreach($note as $n){
                    $noteComm += $n->note_commentaire;
                    $nbNote++;
                }
                $i++;
            }

            if($noteComm != 0 && $i !=0){
                $moyenne = $noteComm / $nbNote;
                $data['listeDerniersLogements'][$j]->note = $moyenne;
            }

            $j++;
        }


        return view('accueil', $data);
    }
}
