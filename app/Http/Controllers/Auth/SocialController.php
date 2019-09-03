<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    /**
     * SocialController constructor.
     * On autorise la route seulement pour les utilisateurs non connectés
     */
     
     //Ce controller est fait pour fonctionner avec les providers : Facebook, Twitter, Google, LinkedIn, GitHub and Bitbucket
     
     
    public function __construct(){
        $this->middleware('guest');
    }






    /**
     * @param $provider
     * @return mixed
     * Fonction qui va se charger de rediriger notre application vers l'url du provider
     */
    public function redirect($provider){
        
        return Socialite::driver($provider)->redirect();
    }









    /**
     * @param $provider
     * @return mixed
     * @throws \Exception
     * Fonction de callback ou le provider nous redirige en passant l'utilisateur
     */
    public function callback($provider){

        //Récupération de l'utilisateur renvoyé
        try{
            $providerUser = Socialite::driver($provider)->user();
        }catch(\Exception $e){
            throw $e;
        }

        //Ici vous pouvez dd($providedUser) pour voir à quoi ressemble
        //les données renvoyées selon le provider

        //Si j'ai déjà le provider_id dans la base de donnée
        //je connecte directement l'utilisateur
        $user = $this->checkIfProviderIdExists($provider, $providerUser->id);
        
        

        if($user){
            Auth::guard()->login($user, true);
            return redirect('/');
        }

        //Je vérifie si j'ai un email
        if($providerUser->email !== null){
            
//            var_dump($providerUser);
//            die;
                

            //Je rajoute le provider_id a l'utilisateur dont le mail
            //correspond et je redirige vers la page appelé
            $user = User::where('email', $providerUser->email)->first();
            if($user){
                $field = $provider.'_id';
                $user->$field = $providerUser->id;
                $user->save();
                Auth::guard()->login($user, true); // true pour garder l'utilisateur connecté ( remember me )
                return redirect('/');
            }
        
        
        
        }
        
        $user = User::create([
            'name' => $providerUser->name,
            'email' => $providerUser->email,
            'avatar' => $providerUser->avatar,
        ]);
        
        
        /*dispo :
        
        "refreshToken"
        "expiresIn"
        "id"
        "nickname"
        "name"
        "email"
        "avatar"
        "user"
        "name"
        "email"
        "avatar_original"
        "profileUrl"
        
        */

        if($user) Auth::guard()->login($user, true);
        return redirect('/');  
        
        
    }
    
    
    // rappel : console google+ --> https://console.developers.google.com/apis / console facebook --> https://developers.facebook.com/apps
    
    
    
  

    /**
     * @param $provider
     * @param $providerId
     * @return mixed
     * Fonction qui vérifie si l'utilisateur à déjà un identifiant
     * venant d'un réseau social
     */
    public function checkIfProviderIdExists($provider, $providerId){

        $field = $provider."_id";

        $user = User::where($field, $providerId)->first();

        return $user;

    }
}
