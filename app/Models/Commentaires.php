<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Commentaires extends Model
{
    
    protected $fillable = ['texte_commentaire','note_commentaire','id_reservation'];
    
    // Récupère le commentaire d'une réservation
    // Paramètres : id de la réservation
    public static function recup($id_resa){
        $recup = DB::table('commentaires')
                ->where('id_reservation','=', $id_resa)
                ->get();
        return $recup;
    }

    // récupère les commentaires d'un habitat
    // Paramètres : id de l'habitat
    public static function getCommentairesByHabitat($idHabitat){
        $data = DB::table('commentaires')
                ->select('commentaires.*', 'users.avatar', 'users.name')
                ->join('reservations', 'reservations.id_reservations', '=', 'commentaires.id_reservation')
                ->join('users', 'users.id', '=', 'reservations.id_user')
                ->where('reservations.id_habitat','=', $idHabitat)
                ->get();
        return $data;
    }

    // Ajoute un commentaire à un habitat par réservation
    // Paramètres : données du commentaire
    //              id de la réservation
    public static function addCommentairesByHabitat($data, $id_reservation){
        DB::table('commentaires')->insertGetId(
            ['texte_commentaire' => $data['commentaire'], 'note_commentaire' => $data['note'], 'id_reservation' => $id_reservation]
        );
    }

    // récupère les commentaires où la note est supérieure à 4
    public static function getTemoignages(){
        $data = DB::table('commentaires')
                ->join('reservations', 'reservations.id_reservations', '=', 'commentaires.id_reservation')
                ->join('users', 'users.id', '=', 'reservations.id_user')
                ->where('note_commentaire','>=', 4)
                ->get();
        return $data;
    }

    // Supprime toutes les photos d'un commentaire
    // Paramètres : id du commentaire
    public static function deletePhotosCommentaireByCommentaire($id_commentaire){
        $supprimerPhoto = DB::table('commentaire_photo')->where('id_commentaires', '=', $id_commentaire)->delete();
        return $supprimerPhoto;
    }

    // supprime le commentaire
    // Paramètres : id du commentaire
    public static function deleteCommentaire($id_commentaire){
        $supprimerComm = DB::table('commentaires')->where('id_commentaires', '=', $id_commentaire)->delete();
        return $supprimerComm;
    }
}
