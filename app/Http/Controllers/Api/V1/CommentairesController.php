<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Transformers\CommentairesTransformer;
use App\Http\Transformers\CommentairePhotoTransformer;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;

use App\Models\Commentaires;
use App\Models\Commentaire_Photo;

class CommentairesController extends Controller
{
    use Helpers;
    
    //fonction pour récupérer les commentaire d'une réservation
    public function recup($id_resa)
    {   
        return $this->response->item(Commentaires::recup($id_resa), new CommentairesTransformer);
    }
    
    //fonction appelé récupérer les photos d'un commentaire
    public function recupphoto($id_comm)
    {   
        return $this->response->item(Commentaire_Photo::recup($id_comm), new CommentairePhotoTransformer);
    }
    
    
    
    
    
    
    public function poster($id_resa, Request $request)
    {   
        if(!empty($_POST)){
            
            $commentaire = new Commentaires(array(
                'texte_commentaire' => $request->input('texte_commentaire'),
                'note_commentaire' => $request->input('note_commentaire'),
                'id_reservation' => $id_resa
            ));
            $commentaire->save();
            
            return $commentaire;
        }
    }
    
    
    
    
    
    
    public function posterphoto($id_comm, Request $request)
    {   
        if(!empty($_FILES)){
          
            //return $_FILES;
            //return $request;
            //return $request->file('photo')->getClientOriginalName();
            
            //quelques variables pour clarifier le code
            $photos_path = public_path('/img/photos/commentaires');
            $photo = $request->file('photo');
            $name = Auth::user()->id."_".$id_comm."_".$request->file('photo')->getClientOriginalName();
            
            // on traite l'image puis on la sauvegarde
            $envoi = Image::make($photo)
            ->orientate()
            ->fit(500, 400)
            ->save($photos_path . '/' . $name);
            
            //et on rajoute l'entrée dans la base
            $commentaire_photo = new Commentaire_Photo(array(                
                'url_commentaire_photo' => $name,
                'id_commentaire' => $id_comm,
                'legende' => ''
            ));
            $commentaire_photo->save();
            
            return "ok";
            
        }else{
            return "error";
        }
    }
    
    
    
    
}
