<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Model
{
    // récupère tous les utilisateurs
    public static function getAllUsers(){
        $data = DB::table('users')
                ->where('id', '<>',Auth::user()->id )
                ->where('id', '<>',1 )
                ->get();

        return $data;

    }

    // récupère le loueur
    // Paramètres : id de l'utilisateur
    public static function getBailleur($id){
        $data = DB::table('users')
                ->where('id', '=', $id)
                ->get();

        return $data;
    }

    // Met à jour l'utilisateur
    // Paramètres : données de l'utilisateur
    public static function updateUser($data){

        $data = DB::table('users')
                ->where('id', Auth::user()->id)
                ->update([  'prenom_user' => $data['prenom'],
                            'nom_user' => $data['nom'],
                            'date_de_naissance' => $data['dateNaissance'],
                            'email' => $data['email'],
                            'description_fr_user' => $data['description'],
                            'telephone_user' => $data['tel'],
                            'adresse_user' => $data['adresse'],
                            'code_postal_user' => $data['cp'],
                            'ville_user' => $data['ville']
                         ]);
        return $data;
    }

    // Met à jour la photo de profil
    // Paramètres : nom de l'image
    public static function editProfilPicture($nameImage){
         $data = DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update([  'avatar' => 'https://atypikhouse2-romaindemay56171454.codeanyapp.com/public/img/avatar/'.$nameImage
                            ]);
        return $data;
    }

    // Supprime l'utilisateur
    // Paramètres : id de l'utilisateur
    public static function deleteUser($id_user){
        $supprimerUser = DB::table('users')->where('id', '=', $id_user)->delete();
        return $supprimerUser;
    }

}
