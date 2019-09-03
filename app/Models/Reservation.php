<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    // récupère toutes les réservation
    public static function getAllResa(){
        $data = DB::table('reservations')
                ->select('*')
                ->get();
        return $data;
    }

    // Récupère les réservations d'un utilisateur
    // Paramètres : id de l'utilisateur
    public static function recapitulatif($id_user){
        $data = DB::table('reservations')
                ->select('*', 'reservations.created_at as crearesa')
                ->join('habitat','habitat.id_habitat',"=","reservations.id_habitat")
                ->join('statut_resa','statut_resa.id_statut_resa',"=","reservations.id_statut_resa")
                ->where('reservations.id_user', '=', $id_user)
                ->get();
        return $data;
    }

    // Récupère la date du début et la date de fin des réservations d'un habitat
    // Paramètres : id de l'habitat
    public static function getResaHabitat($idHabitat){
        $data = DB::table('reservations')
                ->select('date_debut_reservation as start', 'date_fin_reservation as end')
                ->join('habitat','habitat.id_habitat',"=","reservations.id_habitat")
                ->where('reservations.id_habitat', '=', $idHabitat)
                ->where('reservations.id_statut_resa', '=', 1)
                ->get();
        return $data;
    }

    // Récupère l'id des réservation d'un habitat
    // Paramètres : id de l'habitat
    public static function getResaByHabitat($idHabitat){
        $data = DB::table('reservations')
                ->select('id_reservations')
                ->join('habitat','habitat.id_habitat',"=","reservations.id_habitat")
                ->where('reservations.id_habitat', '=', $idHabitat)
                ->where('reservations.id_statut_resa', '=', 1)
                ->get();
        return $data;
    }

    // récupère les réservations en attente par utilisateur (loueur)
    // Paramètres : id de l'utilisateur
    public static function getReservationsReçuesByUser($idUser){
        $data = DB::table('reservations')
                ->join('habitat','habitat.id_habitat',"=","reservations.id_habitat")
                ->join('statut_resa','statut_resa.id_statut_resa',"=","reservations.id_statut_resa")
                ->where('habitat.id_user', '=', $idUser)
                ->where('reservations.id_statut_resa', '=', 2)
                ->get();
        return $data;
    }

    // vérifie si il y a uncommentaire pour réservation sur un habitat
    // Paramètres : id de l'habitat
    //              id de l'utilisateur
    public static function checkReservationCommentaireByHabitat($idHabitat, $idUser){
        $boolean = DB::table('reservations')
                    ->join('commentaires','commentaires.id_reservation',"=","reservations.id_reservations")
                    ->where('id_habitat', $idHabitat)
                    ->where('id_user', $idUser)
                    ->where('id_statut_resa', 1)
                    ->count() > 0;
        return $boolean;
    }

    // vérifie si il y a une réservation d'un utilisateur pour un habitta
    // Paramètres : id de l'habitat
    //              id de l'utilisateur
    public static function getReservationCommentaireByHabitat($idHabitat, $idUser){
        $data = DB::table('reservations')
                    ->select('id_reservations')
                    ->where('id_habitat', $idHabitat)
                    ->where('id_user', $idUser)
                    ->get();
        return $data;
    }

    // supprime les réservations d'un habitat
    // Paramètres : id de l'habitat
    public static function deleteResaHabitat($id_habitat){
        $supprimerResa = DB::table('reservations')->where('id_habitat', '=', $id_habitat)->delete();
        return $supprimerResa;
    }

    // Annnule une réservation
    // Paramètres : id de la réservation
    public static function annulerReservation($id_Reservation){
        DB::table('reservations')
            ->where('id_reservations','=', $id_Reservation)
            ->update(['id_statut_resa' => 3]);
    }

    // récupère les info de la réservation
    // Paramètres : id de la réservation
    public static function getResaById($id_resa){
        $getResa = DB::table('reservations')
            ->select('*')
            ->where('id_reservations','=', $id_resa)
            ->get();
        return $getResa;
    }

    // Accepter la réservation
    // Paramètres : id de l'habitat
    public static function accepterReservation($id_Reservation){
        DB::table('reservations')
            ->where('id_reservations','=', $id_Reservation)
            ->update(['id_statut_resa' => 1]);
    }

    // Met à jour la réservation (met à l'utilisateur 1 quand l'utilisateur d'origine est supprimé)
    // Paramètres : id de l'user'
    public static function updateReservationByUser($id_user){
        $data = DB::table('reservations')
                ->where('id_user','=', $id_user)
                ->update(['id_user' => 1]);
        return $data;
    }

    // Ajoute une réservation
    // Paramètres : données de la réservation
    public static function addReservation($data){
         $data = DB::table('reservations')->insertGetId([
            'date_debut_reservation' => $data['date_debut_reservation'],
            'date_fin_reservation' => $data['date_fin_reservation'],
            'id_user' => $data['id_user'],
            'id_habitat' => $data['id_habitat'],
            'id_statut_resa' => 2,
            'prix' => $data['prix'],
            'paymentId' => $data['paymentId'],
            'token' => $data['token'],
            'PayerID' => $data['PayerID']
        ]);
        return $data;
    }
}
