<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Facturation extends Model
{

    // Ajoute une facturation
    // Paramètres : id de l'habitat
    //              date de début
    //              date de fin
    //              prix réservation
    //              nombre de jours
    //              données de l'habitat
    //              données du loueur
    //              id de la réservation
    public static function addfacturation($id_habitat, $date_debut, $date_end, $prix_resa, $nbJours, $dataHabitat, $dataBailleur, $id_resa){

         $data = DB::table('facturation')->insertGetId([
            'user_name' => Auth::user()->nom_user,
            'user_prenom' => Auth::user()->prenom_user,
            'user_email' => Auth::user()->email,
            'user_adresse' => Auth::user()->adresse_user,
            'user_code_postal' => Auth::user()->code_postal_user,
            'user_ville' => Auth::user()->ville_user,
            'user_telephone' => Auth::user()->telephone_user,
            'id_habitat' => $id_habitat,
            'habitat_titre' => $dataHabitat['titre_habitat'],
            'habitat_adresse' => $dataHabitat['adresse_habitat']." ".$dataHabitat['code_postal_habitat']." ".$dataHabitat['ville_habitat'],
            'bailleur_nom' => $dataBailleur['nom_user'],
            'bailleur_prenom' => $dataBailleur['prenom_user'],
            'bailleur_adresse' => $dataBailleur['adresse_user']." ".$dataBailleur['code_postal_user']." ".$dataBailleur['ville_user'],
            'bailleur_telephone' => $dataBailleur['telephone_user'],
            'facturation_nb_jour' => $nbJours,
            'facturation_prix_total' => $prix_resa,
            'facturation_date_arrivee' => $date_debut,
            'facturation_date_depart' => $date_end,
            'id_reservation' => $id_resa,
            'statut' => 2
        ]);
        return $data;
    }

    // réupère toutes les facturations
    public static function getAllFacturation(){
         $data = DB::table('facturation')
                ->select('*')
                ->get();
        return $data;
    }

    // Supprime une facturation
    // Paramètres : id de la facturation
    public static function deleteFacturation($id){
        $supprimerFacturation = DB::table('facturation')->where('id_facturation', '=', $id)->delete();
        return $supprimerFacturation;
    }

    // Met à jour la facturation
    // Paramètres : id de la facturation
    public static function updateFacturation($id){
        $data = DB::table('facturation')
                ->where('id_reservation','=', $id)
                ->update(['statut' => 1]);
        return $data;
    }

    // Supprime la facturation par réservation
    // Paramètres : id de la réservation
    public static function deleteFacturationByResa($id){
        $data = DB::table('facturation')
                ->where('id_reservation','=', $id)
                ->delete();
        return $data;
    }
}
