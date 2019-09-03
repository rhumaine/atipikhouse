<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Equipement extends Model
{
    protected $table = 'types_equipement';

    // récupère l'équipement
    // Paramètres : id de l'équipement
    public static function getEquipement($id)
    {

        $data = DB::table('types_equipement')
                ->select('*')
                ->where('id_types_equipement', '=', $id)
                ->get();
        return $data;
    }

    // Ajoute un équipement
    // Paramètres : données de l'équipement
    public static function createEquipement($data){

        $data = DB::table('types_equipement')->insert([
            'libelle_fr_types_equipement' => $data['nameFr'],
            'libelle_en_types_equipement' => $data['nameEn']
        ]);
        return $data;
    }

    // Supprime les équipements d'un habitat de la table possède
    // Paramètres : id de l'équipement
    public static function deleteEquipementPossede($id_equipement){
        $supprimerEquipement = DB::table('possede')->where('id_types_equipement', '=', $id_equipement)->delete();
        return $supprimerEquipement;
    }

    // Supprime l'équipement
    // Paramètres : id de l'équipement
    public static function deleteEquipement($id_equipement){
        $supprimerEquipement = DB::table('types_equipement')->where('id_types_equipement', '=', $id_equipement)->delete();
        return $supprimerEquipement;
    }

    // Met à jour un équipement
    // Paramètres : données d'un équipement
    public static function editEquipement($data){
       $data = DB::table('types_equipement')
        ->where('id_types_equipement', $data['id_types_equipement'])
        ->update([  'libelle_fr_types_equipement' => $data['nameFr'],
                    'libelle_en_types_equipement' => $data['nameEn']
                 ]);
        return $data;
    }
}
