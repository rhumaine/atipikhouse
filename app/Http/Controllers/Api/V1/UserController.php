<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Transformers\UserTransformer;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use Helpers;

    //fonction pour récupérer les données d'un utilisateur
    public function userdata()
    {
        return $this->response->item(User::findOrFail(Auth::user()->id), new UserTransformer);
    }
}
