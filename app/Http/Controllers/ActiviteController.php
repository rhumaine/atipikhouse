<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dingo\Api\Facade\Route;

use App\Models\Activite;
use App\Models\Assoc_activites;
use App\Models\Habitat;
use Illuminate\Support\Facades\Auth;


class ActiviteController extends Controller
{
    // fonction pour afficher le formulaire de création de l'activité
    public function index()
    { 
        //retourner aussi la liste des habitat pour pouvoir sélectionner l'activite correspondante ?
        $data['habitats'] = Habitat::getAllMyHabitat(Auth::user()->id);
        

        return view('addactivite', $data);
    }
    
    
    
    // fonction pour créer l'activité
    // Paramètre : la requête
    public function creer(Request $request)
    {   
        if(!empty($_POST)){
            
            $activite = new Activite(array(
                'libelle_fr_activites' => $request->input('titre'),
                'prix_activites' => $request->input('prix'),
                'devise_prix_activites' => $request->input('devise'),
                'nb_places_activites' => $request->input('places'),
                'telephone_activites' => $request->input('telephone'),
                'description_activites' => $request->input('description'),
                'adresse_activites' => $request->input('adresse'),
                'ville_activites' => $request->input('ville'),
                'code_postal_activites' => $request->input('code_postal'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'id_user' => Auth::user()->id
            ));
            $activite->save();
            
            foreach( $request->input('habitats') as $assoc ){
                $checked = new Assoc_activites(array(
                    'id_habitat' => $assoc,
                    'id_activite' => $activite['id_activites']
                ));
                $checked->save();
            };
            
            return redirect()->route('detailactivite', ['id' => $activite['id_activites']]);
        }
    }
    
    //fonction pour afficher la page pour modifier l'activité
    //Paramètre : id de l'activité
    public function modify($id){

        $data['detailActivite'] = Activite::findOrFail($id);
        $data['habitats'] = Habitat::getAllMyHabitat(Auth::user()->id);

        $habitatActivites = Assoc_activites::getHabitatByActivity($id);

        $data['tabHabitat'] = array();
        foreach($habitatActivites as $h){
            array_push($data['tabHabitat'], $h->id_habitat);
        }

        return view('edit-activite', $data);

    }
    
    //fonction pour modifier l'activité
    //Paramètre : id de l'activité
    //            requête
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'titre' => 'required',
            'prix' => 'required',
            'devise' => 'required',
            'places' => 'required',
            'telephone' => 'required',
            'description' => 'required',
            'adresse' => 'required',
            'code_postal' => 'required',
            'ville' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'

        ]);

        Activite::updateActivite($validatedData, $id);


        //suppression de tous les habitats de l'activité
        Assoc_activites::deleteAllHabitatByActivite($id);


        //ajout des habitats en BDD dans la table assoc_activites
        if(!empty($_POST['habitats'])){

            //ajout des equipements
            foreach($_POST['habitats'] as $hab){

                Assoc_activites::addHabitatByActivite($id, $hab);
            }

        }


        return redirect()->route('activite.modify', $id);

    }
    
    //fonction pour afficher le détail de l'activité
    //Paramètre : id de l'activité
    public function detail($id){

        $data = Activite::findOrFail($id);
        $data['listeTypesHabitat'] = Habitat::getTypesHabitat();
        
        //return $data;

        return view('detailactivite', $data);
    }
}
