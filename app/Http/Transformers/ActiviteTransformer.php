<?php

namespace App\Http\Transformers;

use App\Models\Activite;
use League\Fractal\TransformerAbstract;

class ActiviteTransformer extends TransformerAbstract
{
    public function transform(Activite $activite) : array
    {
        return [
          'name' => $activite->id_activites,
          'dates' => $activite->libelle_fr_activites,
          'location' => $activite->libelle_en_activites ,
          'tags' => $activite->prix_activites
        ];
    }
}
