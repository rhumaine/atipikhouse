<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use Dingo\Api\Contract\Http\Request;
//use Illuminate\Http\Request;
use Dingo\Api\Http\Response;
//use Response;
//use Illuminate\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    use Helpers;

    public function __consctruct()
    {
        //$this->middleware('guest', ['except' => 'getLogout']);
    }

    //fonction appelé pour se connecter
    public function login(Request $request)
    {
        if(!empty($_POST)){
            $credentials = $request->only('email','password');

            try{
                if(! $token = JWTAuth::attempt($credentials)) {
                    return $this->response->errorUnauthorized()->setStatusCode(401);
                }
            }catch (JWTException $ex){
                return $this->response->errorInternal();
            }

//            var_dump($this->response->array());
//            die;
            //return $this->response->array();
            return $this->response->array(compact('token'))->setStatusCode(200);
        }else{
            return $this->response->errorUnauthorized();
        }
    }
}
