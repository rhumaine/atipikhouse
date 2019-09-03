<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Activite extends Model
{
    protected $fillable = ['libelle_fr_activites','libelle_en_activites','prix_activites','devise_prix_activites','nb_places_activites','description_activites','telephone_activites','adresse_activites','ville_activites','code_postal_activites','latitude','longitude','id_user'];
    
    protected $primaryKey = 'id_activites';
    
    

    // Récupère toutes les activités du site
    public static function getAllActivites()
    {
        $data = DB::table('activites')
                ->select('*')
                ->get();
        return $data;
    }

    // Supprime une activité
    // Paramètres : id de l'activité
    public static function deleteActivite($id)
    {
        $data = DB::table('activites')->where('id_activites', '=', $id)->delete();
        return $data;
    }

    // Récupère toutes les activités de l'utilisateur par l'id de cet utilisateur
    // Paramètres : id de l'utilisateur
    public static function getAllMyActivities($id)
    {
        $data = DB::table('activites')
                ->select('*')
                ->where('id_user', '=', $id)
                ->get();
        return $data;
    }

    // Met à jour l'activité
    // Paramètres : data de l'activité
    //             id de l'activité
    public static function updateActivite($data, $id)
    {
         DB::table('activites')
            ->where('id_activites', $id)
            ->update([
                'libelle_fr_activites' => $data['titre'],
                'prix_activites' => $data['prix'],
                'devise_prix_activites' => $data['devise'],
                'nb_places_activites' => $data['places'],
                'telephone_activites' => $data['telephone'],
                'description_activites' => $data['description'],
                'adresse_activites' => $data['adresse'],
                'ville_activites' => $data['ville'],
                'code_postal_activites' => $data['code_postal'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude']
        ]);
    }

    // récupère les activités d'un habitat
    // Paramètres : id de l'habitat
    //             latitude de l'habitat
    //             longitude de l'habitat
    public static function getActiviteByHabitat($id_habitat, $latitude, $longitude){

        $data = DB::select('SELECT *, (6366*acos(cos(radians('.$latitude.'))*cos(radians(latitude))*cos(radians(longitude) -radians('.$longitude.'))+sin(radians('.$latitude.'))*sin(radians(latitude)))) AS distance
                            FROM activites A
                            LEFT JOIN assoc_activites B ON B.id_activite = A.id_activites
                            WHERE id_habitat = '.$id_habitat);
        return $data;
    }

}
