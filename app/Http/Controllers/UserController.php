<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\Habitat;
use App\Models\Reservation;
use App\Models\Activite;
use Illuminate\Support\Facades\Auth;
use Dingo\Api\Routing\Helpers;
use Illuminate\View\View;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
//use Dingo\Api\Facade\Route;


class UserController extends Controller
{
    use Helpers;


    //fonction pour afficher le profil de l'utilisateur
    public function account(){


        return view('user-profile');

    }

    //fonction pour modifier l'utilisateur
    public function edit(){

        return view('user-edit-profile');

    }

    //fonction pour afficher les habitat d'un utilisateur
    public function habitats(){


        $data['listeHabitats'] = Habitat::getAllMyHabitat(Auth::user()->id);
        $data['reservation'] = $this->api->get('api/reservation/1');
        return view('mes-habitats', $data);

    }

    //fonction pour afficher les activités de l'utilisateur
    public function activites(){
        $data['listeActivites'] = Activite::getAllMyActivities(Auth::user()->id);
        return view('mes-activites', $data);
    }

    //fonction pour afficher les réservations de l'utilisateur
    public function reservations(){

        $data['listeReservations'] = Reservation::recapitulatif(Auth::user()->id);

        return view('mes-reservations', $data);
    }

    //fonction pour afficher les réservations en attente
    public function reservationsValidation(){

        $data['reservationsAttentes'] = Reservation::getReservationsReçuesByUser(Auth::user()->id);

        return view('reservations-validation', $data);
    }

    //fonction pour mettre à jour l'utilisateur
    public function update(Request $request){

        $validatedData = $request->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'dateNaissance' => 'required',
            'description' => '',
            'email' => 'required',
            'tel' => 'required',
            'adresse' => 'required',
            'cp' => 'required',
            'ville' => 'required',
        ]);

        User::updateUser($validatedData);

        if(!empty($_FILES)){
            if($_FILES['images']['name'] != ""){
               //upload de l'icone du type de bien
                $photo = $request->file('images');

                $file_name = 'avatar_'.Auth::user()->id.'.png';

                // on traite l'image puis on la sauvegarde (version vignettes)
                Image::make($photo)
                ->orientate()
                ->fit(150, 150)
                ->save(public_path('/img/avatar/').''.$file_name);

                User::editProfilPicture($file_name);
            }

        }

        return redirect()->route('user.profil');
    }

}







