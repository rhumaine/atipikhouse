<?php

namespace App\Http\Transformers;

use App\Models\Commentaires;
use League\Fractal\TransformerAbstract;

class CommentairesTransformer extends TransformerAbstract
{
    public function transform(Commentaires $commentaires) : array
    {
        return [
            'id_commentaires' => $commentaires->id_commentaires,
            'texte_commentaire' => $commentaires->texte_commentaire,
            'note_commentaire' => $commentaires->note_commentaire,
            'id_reservation' => $commentaires->id_reservation,
            'created_at' => $commentaires->created_at
        ];
    }
}

        
        