<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Habitat;
use App\Models\Commentaires;
use App\Models\Champ_habitat;
use App\Models\Reservation;
use App\Models\Activite;
use Dingo\Api\Routing\Helpers;
use Illuminate\View\View;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use Dingo\Api\Facade\Route;


class HabitatController extends Controller
{
    use Helpers;

    private $photos_path;
    //fonction appelé à chaque appel de function dans ce controller
    public function __construct()
    {
        $this->photos_path = public_path('/img/photos/habitats/');
    }

    //fonction pour afficher la page de détail de l'habitat
    public function index($id){

        $data['detailHabitat'] = $this->api->get('api/habitat/'.$id);
        $data['photosHabitat'] = $this->api->get('api/habitat/photos/'.$id);
        $data['reservation'] = $this->api->get('api/reservation/'.$id);
        $data['allDispo'] = Habitat::getAllDisponibiliteHabitat($id);
        $dispo = $this->api->get('api/habitat/disponibilite/'.$id);
        if(!empty($dispo)){
            $data['dispoHabitat'] = $dispo;
        }

        $reservations = Reservation::getResaByHabitat($id);
        $reservations = json_decode($reservations, true);

        $noteComm = 0;
        $i = 0;

        if(!empty($reservations)){

            foreach($reservations as $r){
                $note = Habitat::getNoteHabitat($r['id_reservations']);
                $note = json_decode($note, true);

                if(!empty($note)){

                    foreach($note as $n){

                        $noteComm += $n['note_commentaire'];
                    }

                }
                $i++;
            }
        }

        if($noteComm != 0 && $i !=0){
            $data['noteMoyenne'] = $noteComm / $i;
        }

        $data['equipementHabitat'] = $this->api->get('api/habitat/equipement/'.$id);
        $data['listeTypesHabitat'] = Habitat::getTypesHabitat();
        $data['listeCommentaires'] = Commentaires::getCommentairesByHabitat($id);
        $data['champsSupplementaires'] = Habitat::getChampsSuppl($id);

        $data['lastHabitatById'] = Habitat::getLastHabitatById(3, $data['detailHabitat']['id_types_bien'], $id, $data['detailHabitat']['latitude'], $data['detailHabitat']['longitude']);

        $data['listActivites'] = Activite::getActiviteByHabitat($id, $data['detailHabitat']['latitude'], $data['detailHabitat']['longitude']);

        if(Auth::user()){

            $resa = Reservation::getReservationCommentaireByHabitat($id, Auth::user()->id);
            $resa = json_decode($resa, true);

            $data['showForm'] = "ok";
            if(isset($resa) && !empty($resa)){
                $ok = Reservation::checkReservationCommentaireByHabitat($id, Auth::user()->id);

                if($ok){
                    $data['showForm'] = "ok";
                }else{
                    $data['showForm'] = "ko";
                }
            }
        }else{
            $data['showForm'] = "ok";
        }

        return view('detailhabitat', $data);
    }

    //fonction pour afficher le formulaire de création d'habitat
    public function create(){

        $data['typesHabitat'] = $this->api->get('api/habitat/typeHabitat');
        $data['allEquipements'] = $this->api->get('api/habitat/equipement');

        return view('addhabitat', $data);
    }

    //fonction pour afficher le formulaire de création d'un habitat
    public function modify($id){

        $data['detailHabitat'] = $this->api->get('api/habitat/'.$id);
        $data['typesHabitat'] = $this->api->get('api/habitat/typeHabitat');
        $data['allEquipements'] = $this->api->get('api/habitat/equipement');
        $equipementsHabitat = $this->api->get('api/habitat/equipement/'.$id);
        $data['tabEquipement'] = array();
        foreach($equipementsHabitat as $equipement){
            array_push($data['tabEquipement'], $equipement['id_types_equipement']);
        }
        $data['photosHabitat'] = Habitat::getPhotosHabitat($id);
        $data['ChampsSuppHabitat'] =  Habitat::getChampsSuppHabitat($id);

        return view('edit-habitat', $data);
    }

    //fonction pour mettre à jour un habitat
    public function update(Request $request, $id){

        //recuperation des champs supplémentaires
        $ChampsSuppHabitat =  Habitat::getChampsSuppHabitat($id);

        $validatedData = $request->validate([
            'titre' => 'required',
            'typeHabitat' => 'required',
            'superficie' => 'required',
            'capacite' => 'required',
            'description' => 'required',
            'adresse' => 'required',
            'code_postal' => 'required',
            'ville' => 'required',
            'reglement' => 'required',
            'nbLitSimple' => 'required',
            'nbLitDouble' => 'required',
            'heureArrivee' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'images' => ''
        ]);

        Habitat::updateHabitat($request, $id);

        //mise a jour des valeurs des champs supplémentaires
        if(!empty($_POST['champ_sup'])){

            $id_champ_sup = $_POST['id_champ_sup'];
            $i = 0;
            //ajout des valeurs
            foreach($_POST['champ_sup'] as $champ){

                Habitat::updateChampsSupplementaires($id_champ_sup[$i], $champ);
                $i++;
            }
        }

        //suppression de tous les équipements
        Habitat::deleteAllEquipementPossedeByHabitat($id);

        //ajout des équipements en BDD
        if(!empty($_POST['equipements'])){

            //ajout des equipements
            foreach($_POST['equipements'] as $equipement){

                Habitat::addEquipements($id, $equipement);
            }
        }

        //upload des images de l'habitat
        $photos = $request->file('images');

        if($photos != ""){


            if (!is_array($photos)) {
                $photos = [$photos];
            }

            for ($i = 0; $i < count($photos); $i++){
                $photo = $photos[$i];
                $file_name = uniqid('img_').'.'.$photo->getClientOriginalExtension();

                // on traite l'image puis on la sauvegarde (version grandes)
                Image::make($photo)
                ->orientate()
                ->fit(710, 473)
                ->save($this->photos_path . 'grandes/' . $file_name);

                // on traite l'image puis on la sauvegarde (version vignettes)
                Image::make($photo)
                ->orientate()
                ->fit(90, 60)
                ->save($this->photos_path . 'vignettes/' . $file_name);

                Habitat::addImages($id, $file_name);
            }
        }

        return redirect()->route('habitat.modify', $id);
    }

    //fonction pour jaouter un habitat
    public function store(Request $request){

        $validatedData = $request->validate([
            'titre' => 'required',
            'typeHabitat' => 'required',
            'superficie' => 'required',
            'capacite' => 'required',
            'description' => 'required',
            'adresse' => 'required',
            'code_postal' => 'required',
            'ville' => 'required',
            'reglement' => 'required',
            'nbLitSimple' => 'required',
            'nbLitDouble' => 'required',
            'heureArrivee' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'images' => 'required',
        ]);


        //ajout de l'habitat en BDD
        Habitat::addHabitat($request);

        //Recupération de l'id de l'habitat qui vient d'être ajouté
        $lastIdHabitat = DB::getPdo()->lastInsertId();


        //ajout des valeurs des champs supplémentaires
        if(!empty($_POST['champ_sup'])){

            $id_champ_sup = $_POST['id_champ_sup'];
            $i = 0;
            //ajout des valeurs
            foreach($_POST['champ_sup'] as $champ){

                Habitat::addChampsSupplementaires($lastIdHabitat, $id_champ_sup[$i], $champ);
                $i++;
            }

        }

        //ajout des équipements en BDD
        if(!empty($_POST['equipements'])){

            //ajout des equipements
            foreach($_POST['equipements'] as $equipement){

                Habitat::addEquipements($lastIdHabitat, $equipement);
            }

        }

        //upload des images de l'habitat
        $photos = $request->file('images');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        for ($i = 0; $i < count($photos); $i++){
            $photo = $photos[$i];
            $file_name = uniqid('img_').'.'.$photo->getClientOriginalExtension();

            // on traite l'image puis on la sauvegarde (version grandes)
            Image::make($photo)
            ->orientate()
            ->fit(710, 473)
            ->save($this->photos_path . 'grandes/' . $file_name);

            // on traite l'image puis on la sauvegarde (version vignettes)
            Image::make($photo)
            ->orientate()
            ->fit(90, 60)
            ->save($this->photos_path . 'vignettes/' . $file_name);

            Habitat::addImages($lastIdHabitat, $file_name);
        }

        return redirect()->route('detailhabitat', ['id' => $lastIdHabitat]);
    }

    //fonction de recherche
    public function search(Request $request){

        $data['listeTypesHabitat'] = Habitat::getTypesHabitat();
        $data['allEquipements'] = $this->api->get('api/habitat/equipement');

        //recuperation des filtres
        $input = $request->all();
        $data['habitats'] = Habitat::getHabitatByFiltres($input);

        $j=0;
        foreach($data['habitats'] as $h){

            $reservations = Reservation::getResaByHabitat($h->id_habitat);
            $reservations = json_decode($reservations, true);

            $noteComm = 0;
            $i = 0;
            $nbNote = 0;
            foreach($reservations as $r){


                $note = Habitat::getNoteHabitat($r['id_reservations']);

                foreach($note as $n){
                    $noteComm += $n->note_commentaire;
                    $nbNote++;
                }
                $i++;
            }

            if($noteComm != 0 && $i !=0){
                $moyenne = $noteComm / $nbNote;
                $data['habitats'][$j]->note = $moyenne;
            }

            $j++;
        }

        return view('recherche', $data);
    }

    //fonction AJAX pour récupérer les champs supplémentaires d'un type d'habitat
    public function getChamps($id)
    {
        $data = Champ_habitat::getChampByType($id);
        $champ = json_decode($data, true);

        $message = "";
        foreach($champ as $c){
            $message .= "<div class='col-md-4 col-sm-6'>
                            <div class='form-group'>
                                <label class='control-label'>".ucfirst($c['libelle_fr_champ_habitat'])."</label>
                                <input class='input-text' type='".$c['champ_habitat_type']."' name='champ_sup[]' placeholder='".ucfirst($c['libelle_fr_champ_habitat'])."'>
                                <input type='hidden' name='id_champ_sup[]' value='".$c['id_champ_habitat']."'>
                            </div>
                        </div>";
        }
        echo $message;
        exit;
    }

    //fonction pour supprimer une photo
    public function supprimerPhoto($id){

        //suppression de la photo de la BDD
        Habitat::deletePhoto($id);

        //supprimer la photo du serveur
        //unlink(asset('public/img/photos/habitats/grandes/tipi_1.jpg'));

    }

    //fonction pour afficher les disponibilité d'un habitat
    public function getHabitatDispo($id){

        $data['disposHabitat'] = Habitat::getAllDisponibiliteHabitat($id);
        $data['detailHabitat'] = $this->api->get('api/habitat/'.$id);

        return view('dispo-habitat', $data);
    }

    //fonction pour afficher les disponibilité d'un habitat
    public function habitatDispo($id){

        $data['detailHabitat'] = $this->api->get('api/habitat/'.$id);

        return view('add-dispo', $data);
    }

    //fonction pour supprimer une disponibilité d'un habitat
    public function deleteHabitatDispo(){
        if(!empty($_POST)){

            $id_dispo = $_POST['id_dispo'];

            $deleetDispo = Habitat::deleteDispoHabitatByDispo($id_dispo);

            return redirect()->route('habitat.getdispo', ['id' => $_POST['id_habitat']]);
        }else{
            return redirect()->route('user.habitats');
        }
    }

    //fonction ajouter une disponibilité à un habitat
    public function habitatAddDispo(Request $request){

        $validatedData = $request->validate([
            'dateDebut' => 'required',
            'dateFin' => 'required',
            'prixDispo' => 'required',
            'devise' => 'required',
            'idHabitat' => ''
        ]);

        //ajout de l'habitat en BDD
        Habitat::addDispoByHabitat($validatedData);

        return redirect()->route('habitat.getdispo', ['id' => $_POST['idHabitat']]);
    }
}







