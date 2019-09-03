<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Commentaire_Photo extends Model
{
    protected $table = 'commentaire_photo';
    
    protected $fillable = ['url_commentaire_photo','id_commentaire','legende'];
    
    // Récupère les photos d'un commentaire
    // Paramètres : id du commentaire
    public static function recup($id_comm){
        $recup = DB::table('commentaire_photo')
                ->where('id_commentaire','=', $id_comm)
                ->get();
        return $recup;
    }
    
    // Récupère toutes les photos des commentaires
    public static function getAllPhoto(){
         $recup = DB::table('commentaire_photo')
                ->get();
        return $recup;
    }

    // Supprime la photo d'un commentaire
    // Paramètres : id du commentaire_photo
    public static function deletePhoto($id_commentaire_photo){
        $supprimerPhoto = DB::table('commentaire_photo')->where('id_commentaire_photo', '=', $id_commentaire_photo)->delete();
        return $supprimerPhoto;
    }

}
