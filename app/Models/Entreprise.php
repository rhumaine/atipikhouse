<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Entreprise extends Model
{

    // récupère les données de l'entreprise
    public static function getEntreprise(){
         $data = DB::table('entreprise')
                ->select('*')
                ->get();
        return $data;
    }

    // Met à jour les données de l'entreprise
    // Paramètres : données de l'entreprise
    public static function updateEntreprise($data){
        $data = DB::table('entreprise')
        ->where('id_entreprise', 1)
        ->update([  'libelle_entreprise' => $data['nameFr'],
                    'description_fr_entreprise' => $data['description_fr'],
                    'description_en_entreprise' => $data['description_en'],
                    'adresse_entreprise' => $data['adresse'],
                    'ville_entreprise' => $data['ville'],
                    'code_postal_entreprise' => $data['code_postal'],
                    'telephone_entreprise' => $data['telephone'],
                 ]);
        return $data;
    }
}
