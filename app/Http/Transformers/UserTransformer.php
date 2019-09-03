<?php

namespace App\Http\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user) : array
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'prenom_user' => $user->prenom_user,
            'nom_user' => $user->nom_user,
            'adresse_user' => $user->adresse_user,
            'ville_user' => $user->ville_user,
            'code_postal_user' => $user->code_postal_user,
            'telephone_user' => $user->telephone_user,
            'description_fr_user' => $user->description_fr_user,
            'description_en_user' => $user->description_en_user,
            'avatar' => $user->avatar
        ];
    }
}
