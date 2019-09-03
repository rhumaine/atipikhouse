<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Habitat extends Model
{
    protected $table = 'habitat';
    protected $primaryKey = 'id_habitat';
    
    protected $fillable = ['titre_habitat','adresse_habitat','ville_habitat','code_postal_habitat','latitude','longitude','description_fr_habitat','description_en_habitat','surface_m2_habitat','heure_arrivee_habitat','nb_lit_simple_habitat','nb_lit_double_habitat','capacite_habitat','reglement_fr_habitat','reglement_en_habitat','fumeur_habitat','id_types_bien','id_user'];

    // récupère les types de bien
    public static function getTypesHabitat(){
        $data = DB::table('types_bien')
                ->select('*')
                ->get();
        return $data;
    }

    // récupère les données d'un type de bien
    // Paramètres : id du type de bien
    public static function getTypeBien($id_type_bien){
        $data = DB::table('types_bien')
                ->select('*')
                ->where('id_types_bien', '=', $id_type_bien)
                ->get();
        return $data;
    }

    // Ajoute les activités à un habitat
    // Paramètres : id de l'habitat
    //
    public static function createTypeBien($data){
        $data = DB::table('types_bien')->insert([
            'libelle_fr_types_bien' => $data['nameFr'],
            'libelle_en_types_bien' => $data['nameEn']
        ]);
        return $data;
    }

    // Met à jour un type de bien
    // Paramètres : données du type de bien
    public static function editTypeBien($data){
       $data = DB::table('types_bien')
        ->where('id_types_bien', $data['id_types_bien'])
        ->update([  'libelle_fr_types_bien' => $data['nameFr'],
                    'libelle_en_types_bien' => $data['nameEn']
                 ]);
        return $data;
    }

    // Supprime un type de bien
    // Paramètres : id du type de bien
    public static function deleteTypeBien($id_type_bien){
        $supprimerTypesBien = DB::table('types_bien')->where('id_types_bien', '=', $id_type_bien)->delete();
        return $supprimerTypesBien;
    }

    // Ajoute une icone à un type de bien
    // Paramètres : id du type de bien
    //              nom de l'image
    public static function addIconTypeBien($idTypeBien, $nameImage){
        $data = DB::table('types_bien')
        ->where('id_types_bien', $idTypeBien)
        ->update([  'icone_bien' => $nameImage
                 ]);
        return $data;
    }

    // Met à jour une icone d'un type de bien
    // Paramètres : id du type de bien
    //              nom de l'image
    public static function editIconTypeBien($idTypeBien, $nameImage){
        $data = DB::table('types_bien')
        ->where('id_types_bien', $idTypeBien)
        ->update([  'icone_bien' => $nameImage
                 ]);
        return $data;
    }

    // récupère les champs supplémentaire d'un habitat
    // Paramètres : id de l'habitat
    public static function getChampsSuppl($id_habitat){
        $data = DB::table('valeur_champ_habitat')
                ->join('champ_habitat', 'champ_habitat.id_champ_habitat', '=', 'valeur_champ_habitat.id_champ_habitat')
                ->select('*')
                ->where('valeur_champ_habitat.id_habitat', '=', $id_habitat)
                ->get();
        return $data;
    }

    // Récupère les photos d'un habitat
    // Paramètres : id de l'habitat
    public static function getPhotosHabitat($id_habitat){
        $data = DB::table('photos_habitation')
                ->select('*')
                ->where('id_habitat', '=', $id_habitat)
                ->get();
        return $data;
    }

    // Supprime les photos d'un habitat
    // Paramètres : id de l'habitat
    public static function deletePhotosHabitat($id_habitat){
        $supprimerPhotosHabitat = DB::table('photos_habitation')->where('id_habitat', '=', $id_habitat)->delete();
        return $supprimerPhotosHabitat;
    }

    // Supprime une photo d'un habitat
    // Paramètres : id de la photo
    public static function deletePhoto($id_photo){
        DB::table('photos_habitation')->where('id_photo_habitation', '=', $id_photo)->delete();
    }

    // Ajoute une disponibilité à un habitat
    // Paramètres : données de la disponibilité
    public static function addDispoByHabitat($data){
        list($day, $month, $year) = explode("/", $data['dateDebut']);

        $data['dateDebut'] = $year."-".$month."-".$day;


        list($day, $month, $year) = explode("/", $data['dateFin']);

        $data['dateFin'] = $year."-".$month."-".$day;


         DB::table('disponibilites')->insert([
            'date_debut_disponibilites' => $data['dateDebut'],
            'date_fin_disponibilites' => $data['dateFin'],
            'prix_disponibilites' => $data['prixDispo'],
            'devise_prix_disponibilites' => $data['devise'],
            'id_habitat' => $data['idHabitat']
        ]);
    }

    // récupère les disponiblités d'un habitat en fonction de la date d'aujourd'hui
    // Paramètres : id de l'habitat
    public static function getDisponibiliteHabitat($id_habitat){
        $data = DB::table('disponibilites')
                ->select('*')
                ->where('id_habitat', '=', $id_habitat)
                ->where('date_debut_disponibilites', '<', date('Y-m-d'))
                ->where('date_fin_disponibilites', '>', date('Y-m-d'))
                ->get();
        return $data;
    }

    // Récupère la disponibilité en fonction de la date de début da la réservation
    // Paramètres : id de l'habitat
    //              date de début de la réservation
    public static function getDisponibiliteResa($id_habitat, $date_debut){
        $data = DB::table('disponibilites')
                ->select('*')
                ->where('id_habitat', '=', $id_habitat)
                ->where('date_debut_disponibilites', '<', $date_debut)
                ->where('date_fin_disponibilites', '>', $date_debut)
                ->get();
        return $data;
    }

    // Récupère toutes les disponibilités d'un habitat
    // Paramètres : id de l'habitat
    public static function getAllDisponibiliteHabitat($id_habitat){
        $data = DB::table('disponibilites')
                ->select('*')
                ->where('id_habitat', '=', $id_habitat)
                ->get();
        return $data;
    }

    // Supprime les disponibilités d'un habitat
    // Paramètres : id de l'habitat
    public static function deleteDispoHabitat($id_habitat){
        $supprimerDispoHabitat = DB::table('disponibilites')->where('id_habitat', '=', $id_habitat)->delete();
        return $supprimerDispoHabitat;
    }

    // Supprime une disponibilité d'un habitat
    // Paramètres : id de la disponibilité
    public static function deleteDispoHabitatByDispo($id_dispo){
        $supprimerDispoHabitat = DB::table('disponibilites')->where('id_disponibilite', '=', $id_dispo)->delete();
        return $supprimerDispoHabitat;
    }

    // récupère les équipements d'un habitat
    // Paramètres : id de l'habitat
    public static function getEquipementHabitat($id_habitat){
        $data = DB::table('possede')
                ->select('*')
                ->join('types_equipement', 'possede.id_types_equipement', '=', 'types_equipement.id_types_equipement')
                ->where('possede.id_habitat', '=', $id_habitat)
                ->get();
        return $data;
    }

    // Supprime les équipements d'un habitat
    // Paramètres : id de l'habitat
    public static function deleteEquipementByHabitat($id_habitat){
        $supprimerEquipHabitat = DB::table('possede')->where('id_habitat', '=', $id_habitat)->delete();
        return $supprimerEquipHabitat;
    }

    // récupère tous les équipements
    public static function getAllEquipements(){
        $data = DB::table('types_equipement')
                ->select('*')
                ->orderBy('libelle_fr_types_equipement', 'asc')
                ->get();
        return $data;
    }

    // Ajoute un habitat
    // Paramètres : données de l'habitat
    public static function addHabitat($data){

        DB::table('habitat')->insert([
            'titre_habitat' => $data->titre,
            'adresse_habitat' => $data->adresse,
            'code_postal_habitat' => $data->code_postal,
            'ville_habitat' => $data->ville,
            'description_fr_habitat' => $data->description,
            'surface_m2_habitat' => $data->superficie,
            'heure_arrivee_habitat' => $data->heureArrivee,
            'nb_lit_simple_habitat' => $data->nbLitSimple,
            'nb_lit_double_habitat' => $data->nbLitDouble,
            'capacite_habitat' => $data->capacite,
            'reglement_fr_habitat' => $data->reglement,
            'fumeur_habitat' => 1,
            'id_types_bien' => $data->typeHabitat,
            'id_user' => Auth::user()->id,
            'latitude' => $data->latitude,
            'longitude' => $data->longitude
        ]);
    }

    // Met à jour un habitat
    // Paramètres : données de l'habitat
    //              id de l'habitat
    public static function updateHabitat($data, $id){

        DB::table('habitat')
            ->where('id_habitat', $id)
            ->update([
            'titre_habitat' => $data->titre,
            'adresse_habitat' => $data->adresse,
            'code_postal_habitat' => $data->code_postal,
            'ville_habitat' => $data->ville,
            'description_fr_habitat' => $data->description,
            'surface_m2_habitat' => $data->superficie,
            'heure_arrivee_habitat' => $data->heureArrivee,
            'nb_lit_simple_habitat' => $data->nbLitSimple,
            'nb_lit_double_habitat' => $data->nbLitDouble,
            'capacite_habitat' => $data->capacite,
            'reglement_fr_habitat' => $data->reglement,
            'fumeur_habitat' => 1,
            'id_types_bien' => $data->typeHabitat,
            'id_user' => Auth::user()->id,
            'latitude' => $data->latitude,
            'longitude' => $data->longitude
        ]);
    }

    // Met à jour les champs supplémentaires
    // Paramètres : id de l'habitat
    //              id du champ supplémentaire
    //              valeur du champ
    public static function updateChampsSupplementaires($id_champ_habitat, $valeur){
         DB::table('valeur_champ_habitat')
            ->where('id_champ_habitat', $id_champ_habitat)
            ->update([
            'valeur' => $valeur
        ]);
    }


    // Supprime les habitats d'un utilisateur
    // Paramètres : id de l'utilisateur
    public static function deleteHabitatByUser($id_user){
        $supprimerResa = DB::table('habitat')->where('id_user', '=', $id_user)->delete();
        return $supprimerResa;
    }

    // Ajoute un équipement à un habitat
    // Paramètres : id de l'habitat
    //              id de l'équipement
    public static function addEquipements($idHabitat, $idEquipement){
        $data = DB::table('possede')->insert([
            'id_habitat' => $idHabitat,
            'id_types_equipement' => $idEquipement
        ]);
        return $data;
    }

    // Supprime tous les équipements que possède un habitat
    // Paramètres : id de l'habitat
    public static function deleteAllEquipementPossedeByHabitat($id_habitat){
        DB::table('possede')
            ->where('id_habitat', '=', $id_habitat)
            ->delete();
    }

    // Ajoute le champ supplémentaire à un habitat
    // Paramètres : id de l'habitat
    //              id du champ
    //              valeur du champ
    public static function addChampsSupplementaires($idHabitat, $id_champ, $valeur){
        DB::table('valeur_champ_habitat')->insert([
            'id_habitat' => $idHabitat,
            'id_champ_habitat' => $id_champ,
            'valeur' => $valeur
        ]);
    }

    // récupère les champ supplémentaire d'un habitat
    // Paramètres : id de l'habitat
    public static function getChampsSuppHabitat($id_habitat){
        $data = DB::table('champ_habitat')
                ->join('valeur_champ_habitat', 'valeur_champ_habitat.id_champ_habitat', '=', 'champ_habitat.id_champ_habitat')
                ->select('*')
                ->where('id_habitat', '=', $id_habitat)
                ->get();
        return $data;
    }

    // Ajoute une image à l'habitat
    // Paramètres : id de l'habitat
    //              nom de l'image
    public static function addImages($idHabitat, $nameImage){
        $data = DB::table('photos_habitation')->insert([
            'url_photos_habitation' => $nameImage,
            'libelle_photo' => $nameImage,
            'id_habitat' => $idHabitat
        ]);
        return $data;
    }

    // Récupère les X derniers habitats
    // Paramètres : nombre d'habitat
    public static function getLastHabitat($nb){

        $data = DB::select('SELECT H.*, TB.*, min(D.prix_disponibilites) as prix_disponibilites, PH.url_photos_habitation
                            FROM habitat H
                            LEFT JOIN disponibilites D ON D.id_habitat = H.id_habitat
                            LEFT JOIN photos_habitation PH ON PH.id_habitat = H.id_habitat
                            LEFT JOIN types_bien TB ON TB.id_types_bien = H.id_types_bien
                            GROUP BY H.id_habitat
                            ORDER BY H.id_habitat desc
                            LIMIT ?', [$nb]);
        return $data;
    }

    // récupère les derniers habitat en fonction du type de bien et qui sont différent de l'habitat affiché sur la page de ce dernier
    // Paramètres : nombre d'habitat
    //              id du type de bien
    //              id de l'habitat
    //              latitude de l'habitat
    //              longitude de l'habitat
    public static function getLastHabitatById($nb, $id_type_bien, $id, $latitude, $longitude){

        $data = DB::select('SELECT H.*, TB.*, min(D.prix_disponibilites) as prix_disponibilites, PH.url_photos_habitation,
                            (6366*acos(cos(radians('.$latitude.'))*cos(radians(latitude))*cos(radians(longitude) -radians('.$longitude.'))+sin(radians('.$latitude.'))*sin(radians(latitude)))) AS distance
                            FROM habitat H
                            LEFT JOIN disponibilites D ON D.id_habitat = H.id_habitat
                            LEFT JOIN photos_habitation PH ON PH.id_habitat = H.id_habitat
                            LEFT JOIN types_bien TB ON TB.id_types_bien = H.id_types_bien
                            WHERE H.id_types_bien = '.$id_type_bien.'
                            AND H.actif = 1
                            AND H.id_habitat <> '.$id.'
                            GROUP BY H.id_habitat
                            HAVING distance <= 50
                            LIMIT ?', [$nb]);
        return $data;
    }

    // récupère le nombre de logement du site
    public static function getNbLogements(){
        $data = DB::table('habitat')
                ->count();

        return $data;
    }

    // récupère le nombre d'utilisateur du site
    public static function getNbUsers(){
        $data = DB::table('users')
                ->count();

        return $data;
    }

    // récupère le nombre de type de bien
    public static function getNbTypesBien(){
        $data = DB::table('types_bien')
                ->count();

        return $data;
    }

    // récupère la note d'un commentaire pour une réservtion
    // Paramètres : id de la réservation
    public static function getNoteHabitat($id_reservations){
        $data = DB::table('commentaires')
                ->select('note_commentaire')
                ->where('id_reservation','=', $id_reservations)
                ->get();
        return $data;
    }

    // récupère tous les habitats
    public static function getAllHabitat(){
         $data = DB::table('habitat')
                ->select('habitat.*', 'photos_habitation.url_photos_habitation', 'disponibilites.prix_disponibilites', 'types_bien.icone_bien')
                ->join('disponibilites', 'habitat.id_habitat', '=', 'disponibilites.id_habitat')
                ->join('photos_habitation', 'habitat.id_habitat', '=', 'photos_habitation.id_habitat')
                ->join('types_bien', 'habitat.id_types_bien', '=', 'types_bien.id_types_bien')
                ->whereDate('date_debut_disponibilites', '<', date('Y-m-d'))
                ->whereDate('date_fin_disponibilites', '>', date('Y-m-d'))
                ->groupBy('titre_habitat')
                ->get();
        return $data;
    }

    // récupère tous les habitats d'un utilisateur
    // Paramètres : id de l'utilisateur
    public static function getAllMyHabitat($idUser){
         $data = DB::table('habitat')
                ->select('habitat.*', 'photos_habitation.url_photos_habitation')
                ->leftJoin('photos_habitation', 'habitat.id_habitat', '=', 'photos_habitation.id_habitat')
                ->where('habitat.id_user', '=', $idUser)
                ->groupBy('titre_habitat')
                ->orderBy('habitat.created_at', 'desc')
                ->get();
        return $data;
    }

    // Recherche avancées
    // Paramètres : données du formulaire
    public static function getHabitatByFiltres($data){

        $requete = "SELECT H.*, TB.*, min(D.prix_disponibilites) as prix_disponibilites, PH.url_photos_habitation
                    FROM habitat H
                    LEFT JOIN disponibilites D ON D.id_habitat = H.id_habitat
                    LEFT JOIN reservations R ON R.id_habitat = H.id_habitat
                    LEFT JOIN photos_habitation PH ON PH.id_habitat = H.id_habitat
                    LEFT JOIN possede P ON P.id_habitat = H.id_habitat
                    LEFT JOIN types_bien TB ON TB.id_types_bien = H.id_types_bien
                    WHERE 1=1";

        //Gestion des équipements
        if(isset($data['equipements']) && $data['equipements'] != ''){
            foreach($data['equipements'] as $equipement){
                $equipements = " AND id_types_equipement = ".$equipement;
            }
        }else{
            $equipements = "";
        }

        //filtre type hébergement
        if(isset($data['type_hebergement']) && $data['type_hebergement'] != '' && $data['type_hebergement'] != 0){
            $type_hebergement = " AND H.id_types_bien = ".$data['type_hebergement'];
        }else{
            $type_hebergement = "";
        }

        //filtre capacité
        if(isset($data['capacite']) && $data['capacite'] != '' && $data['capacite'] != 0){
            $capacite = " AND H.capacite_habitat >= ".$data['capacite'];
        }else{
            $capacite = "";
        }

        //filtre prix min
        if(isset($data['min_prix']) && $data['min_prix'] != ''){
            $min_prix = " AND prix_disponibilites >= ".$data['min_prix'];
        }else{
            $min_prix = "";
        }

        //filtre prix max
        if(isset($data['max_prix']) && $data['max_prix'] != ''){
            $max_prix = " AND prix_disponibilites <= ".$data['max_prix'];
        }else{
            $max_prix = "";
        }


        //filtre date arrivée
        if(isset($data['date_start']) && $data['date_start'] != ''){

            list($day, $month, $year) = explode('/', $data['date_start']);
            $date_deb = $year."-".$month."-".$day;
            $date_start = " AND date_debut_disponibilites <= '".$date_deb."'";

        }else{
            $date_start = "";
        }

        //filtre date départ
        if(isset($data['date_end']) && $data['date_end'] != ''){

            list($day, $month, $year) = explode('/', $data['date_end']);
            $date_fin = $year."-".$month."-".$day;
            $date_end = " AND date_fin_disponibilites >= '".$date_fin."'";

        }else{
            $date_end = "";
        }



        //check que il n'y a pas de réservation sur les dates demandées
        $data['listeReservation'] = DB::select("SELECT date_debut_reservation, date_fin_reservation
                                                FROM reservations");


        $reqCheckReservation = "";
        if(!empty($data['listeReservation']) && isset($data['date_start']) && $data['date_start'] != '' && isset($data['date_end']) && $data['date_end'] != ''){

            foreach($data['listeReservation'] as $reservation){

                $reqCheckReservation .= " AND '".$reservation->date_fin_reservation."' <= '".$date_deb."' || '".$reservation->date_debut_reservation."' >= '".$date_fin."'";

            }
        }


        $requete = $requete.$type_hebergement.$capacite.$min_prix.$max_prix.$date_start.$date_end.$equipements.$reqCheckReservation." GROUP BY H.id_habitat";


        $data = DB::select($requete);
        return $data;

    }

}
