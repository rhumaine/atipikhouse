<?php

namespace App\Http\Transformers;

use App\Models\Commentaires;
use League\Fractal\TransformerAbstract;

class CommentairePhotoTransformer extends TransformerAbstract
{
    public function transform(CommentairePhoto $commentaire_photo) : array
    {
        return [
            'id_commentaire_photo' => $commentaire_photo->id_commentaire_photo,
            'url_commentaire_photo' => $commentaire_photo->url_commentaire_photo,
            'id_commentaire' => $commentaire_photo->id_commentaire,
            'legende' => $commentaire_photo->legende,
            'created_at' => $commentaire_photo->created_at
        ];
    }
}

        
        