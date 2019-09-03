<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Transformers\ActiviteTransformer;
use App\Models\Activite;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;


class ActiviteController extends Controller
{
    use Helpers;

    //fonction appelé récupérer une activité
    public function index(Request $request) : Response
    {

        //return $this->response->collection(Activite::all(), new ActiviteTransformer);
        
        //return $this->response->array(Activite::all()->toArray())->header('Access-Control-Allow-Credentials', 'true');
        return $this->response->array(Activite::all()->toArray());
        //return $this->response->item(Activite::all(), new ActiviteTransformer);//ca sert à rien
    }
}
