<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Champ_habitat extends Model
{

    // Récupère le champ de l'habitat
    // Paramètres : id ddu champ
    public static function getChamp($id){
        $champ = DB::table('champ_habitat')
                ->select('*')
                ->where('id_champ_habitat', '=', $id)
                ->get();
        return $champ;
    }

    // Récupère les champs
    public static function getChampHabitat(){
        $champ = DB::table('champ_habitat')
                ->get();
        return $champ;
    }

    // Ajoute les types de bien d'un champ
    // Paramètres : id du champ
    public static function getTypeBienByChamp($id){
        $champ = DB::table('propose')
                ->select('id_type_bien')
                ->where('id_champ_habitat', '=', $id)
                ->get();
        return $champ;
    }

    // Récupère les champs d'un type de bien
    // Paramètres : id ddu type de bien
    public static function getChampByType($id){
        $champ = DB::table('propose')
                ->select('*')
                ->join('champ_habitat', 'champ_habitat.id_champ_habitat', '=', 'propose.id_champ_habitat')
                ->where('propose.id_type_bien', '=', $id)
                ->get();
        return $champ;
    }

    // Supprime les champs dans la table propose
    // Dissocie le champ d'un type de bien
    // Paramètres : id du champ
    public static function deleteChampPossede($id_champ){
        $supprimerChamp = DB::table('propose')->where('id_champ_habitat', '=', $id_champ)->delete();
        return $supprimerChamp;
    }

    // Supprime le champ
    // Paramètres : id du champ
    public static function deleteChamp($id_champ){
        $supprimerChamp = DB::table('champ_habitat')->where('id_champ_habitat', '=', $id_champ)->delete();
        return $supprimerChamp;
    }

    // Ajoute un champ
    // Paramètres : données du champ
    public static function createChamp($data){

        $data = DB::table('champ_habitat')->insertGetId([
            'libelle_fr_champ_habitat' => $data['nameFr'],
            'libelle_en_champ_habitat' => $data['nameEn'],
            'champ_habitat_type' => $data['typeChamp']
        ]);
        return $data;
    }

    // Met un jour un champ
    // Paramètres : données du champ
    public static function editChamp($data){
       $data = DB::table('champ_habitat')
        ->where('id_champ_habitat', $data['id_champ_habitat'])
        ->update([  'libelle_fr_champ_habitat' => $data['nameFr'],
                    'libelle_en_champ_habitat' => $data['nameEn'],
                    'champ_habitat_type' => $data['typeChamp']
                 ]);
        return $data;
    }

    // Ajoute un champ à un type de bien dans la table propose
    // Paramètres : id du type de bien
    //              id du champ
    public static function addChamp($idTypeBien, $idChamp){
        $data = DB::table('propose')->insert([
            'id_type_bien' => $idTypeBien,
            'id_champ_habitat' => $idChamp
        ]);
        return $data;
    }
}
