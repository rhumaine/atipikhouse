<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Assoc_activites extends Model
{
    protected $fillable = ['id_habitat','id_activite'];
    

    // récupère les habitats associé à une activité
    // Paramètres : id de l'activité
    public static function getHabitatByActivity($id){
        $data = DB::table('assoc_activites')
                ->select('*')
                ->where('id_activite', '=', $id)
                ->get();
        return $data;
    }

    // supprime l'activité des habitats
    // Paramètres : id de l'activité
    public static function deleteAllHabitatByActivite($id){
        $supprimer = DB::table('assoc_activites')->where('id_activite', '=', $id)->delete();
        return $supprimer;
    }

    // Ajoute les activités à un habitat
    // Paramètres : id de l'habitat
    //              id de l'habitat
    public static function addHabitatByActivite($id_act, $id_hab){
        $data = DB::table('assoc_activites')->insert([
            'id_activite' => $id_act,
            'id_habitat' => $id_hab
        ]);
        return $data;
    }
}
