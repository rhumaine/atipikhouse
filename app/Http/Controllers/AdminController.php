<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Habitat;
use App\Models\Commentaires;
use App\Models\Commentaire_Photo;
use App\Models\Reservation;
use App\Models\Facturation;
use App\Models\Entreprise;
use App\Models\Equipement;
use App\Models\Champ_habitat;
use App\Models\Activite;
use Dingo\Api\Routing\Helpers;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    use Helpers;

    //fonction pour afficher l'accueil
    public function index()
    {
        if(Auth::user()->admin == 1){

            return view('admin.admin');

        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour afficher les utilisateurs
    public function users()
    {

        if(Auth::user()->admin == 1){

        $data['listeUsers'] = User::getAllUsers();

        return view('admin.admin-users', $data);

        }else{
            return redirect()->route('accueil');
        }

    }

    //fonction pour supprimer l'utilisateur
    public function supprimerUser()
    {

        if(!empty($_POST)){
            $id_user = $_POST['id_user'];

            //recup habitat de l'user
            $userHabitats = Habitat::getAllMyHabitat($id_user);

            //boucle sur les habitats
            foreach($userHabitats as $userHabitat){
            //COMMENTAIRE
                //recup les id des commentaires de cet habitat
                $idCommentaireByHabitat = Commentaires::getCommentairesByHabitat($userHabitat->id_habitat);

                //boucle sur les commentaires des habitats
                foreach($idCommentaireByHabitat as $i){
                    //supprimer les photos du commentaire
                    $deletePhotoCommentaire = Commentaires::deletePhotosCommentaireByCommentaire($i->id_commentaires);

                    //on supprime le commentaire en question
                    $deleteCommentaire = Commentaires::deleteCommentaire($i->id_commentaires);
                }

            //PHOTOS

                $deletePhotoHabitat = Habitat::deletePhotosHabitat($userHabitat->id_habitat);

            //DISPONIBILITE

                $deleteDispo = Habitat::deleteDispoHabitat($userHabitat->id_habitat);

            //RESERVATION

                $deleteReservation = Reservation::deleteResaHabitat($userHabitat->id_habitat);

            //VIDER TABLE POSSEDE avec id_habitat

                $deletePossede_equipement = Habitat::deleteEquipementByHabitat($userHabitat->id_habitat);

            //DELETE L'HABITAT
                $deleteHabitatByUser = Habitat::deleteHabitatByUser($id_user);
            }

            //UPDATE RESERVATION sur les autres habitats
            $updateResa = Reservation::updateReservationByUser($id_user);


            //DELETE L'USER
            $deleteUser = User::deleteUser($id_user);


            return redirect()->route('admin.users');
        }else{
            return redirect()->route('admin.users');
        }
    }

    //fonction pour afficher la page des paramètres habitats de l'admin
    public function paramsHabitats()
    {
        if(Auth::user()->admin == 1){

            return view('admin.admin-params');

        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour afficher les commentaires
    public function commentairesHabitats()
    {
        if(Auth::user()->admin == 1){

            $reservations = Reservation::getAllResa();
            foreach($reservations as $r){
                $data['allCom'][$r->id_habitat] = $this->api->get('api/habitat/'.$r->id_habitat);
                $data['allCom'][$r->id_habitat]['commentaires'] = Commentaires::getCommentairesByHabitat($r->id_habitat);
            }

            return view('admin.admin-commentaire', $data);

        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour afficher les photos
    public function photoCommentaire()
    {
        if(Auth::user()->admin == 1){

            $data['photos'] = Commentaire_Photo::getAllPhoto();

            return view('admin.admin-photos', $data);

        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour afficher la page des paramètres des habitat
    public function paramsEquipementHabitats()
    {
        if(Auth::user()->admin == 1){

            $data['allEquipements'] = $this->api->get('api/habitat/equipement');

            return view('admin.admin-params-equipements', $data);

        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour afficher la page des champs supplémentaires des habitats
    public function paramsChampsHabitats()
    {
        if(Auth::user()->admin == 1){

            $data['allChamps'] = Champ_habitat::getChampHabitat();


            return view('admin.admin-params-champs', $data);

        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour créer un équipement
    public function createEquipement(Request $request)
    {
        if(Auth::user()->admin == 1){
            if(empty($_POST)){
                return view('admin.admin-create-params-equipement');
            }else{

                $validatedData = $request->validate([
                    'nameFr' => 'required',
                    'nameEn' => 'required'
                ]);


                Equipement::createEquipement($validatedData);

                return redirect()->route('admin.paramsEquipement');
            }
        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour supprimer un équipement
    public function deleteEquipement()
    {

        if(!empty($_POST)){
            $id_equipement = $_POST['id_equipement'];


            $deleteEquipementPossede = Equipement::deleteEquipementPossede($id_equipement);

            //DELETE L'EQUIPEMENT'
            $deleteEquipement = Equipement::deleteEquipement($id_equipement);


            return redirect()->route('admin.paramsEquipement');
        }else{
            return redirect()->route('admin.paramsEquipement');
        }
    }

    //fonction pour supprimer un champ supplémentaire
    public function deleteChamp()
    {

        if(!empty($_POST)){
            $id_champ = $_POST['id_champ'];


            $deleteChampPossede = Champ_habitat::deleteChampPossede($id_champ);

            //DELETE LE CHAMP
            $deleteChamp = Champ_habitat::deleteChamp($id_champ);


            return redirect()->route('admin.paramsChamps');
        }else{
            return redirect()->route('admin.paramsChamps');
        }
    }

    //fonction pour créer un champ
    public function createChamp(Request $request)
    {
        if(Auth::user()->admin == 1){
            if(empty($_POST)){
                $data['typeBiens'] = Habitat::getTypesHabitat();

                return view('admin.admin-create-params-champs', $data);
            }else{

                $validatedData = $request->validate([
                    'nameFr' => 'required',
                    'nameEn' => 'required',
                    'typeChamp' => 'required',
                    'typeBien' => 'required'
                ]);

                $lastIdChamp = Champ_habitat::createChamp($validatedData);

                if(!empty($_POST['typeBien'])){

                    if($_POST['typeBien'][0] == "All"){
                        $allTypeBien = Habitat::getTypesHabitat();

                        foreach($allTypeBien as $typeBien){
                            Champ_habitat::addChamp($typeBien->id_types_bien, $lastIdChamp);
                        }
                    }else{
                        foreach($_POST['typeBien'] as $typeBien){
                            Champ_habitat::addChamp($typeBien, $lastIdChamp);
                        }
                    }
                }

                return redirect()->route('admin.paramsChamps');
            }
        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour modifier un équipement
    public function editEquipement($id, Request $request)
    {
        if(Auth::user()->admin == 1){
            if(empty($_POST)){

                $data['equipement'] = $this->api->get('api/habitat/equipements/'.$id);

                return view('admin.admin-edit-params-equipements', $data);
            }else{

                $validatedData = $request->validate([
                    'nameFr' => 'required',
                    'nameEn' => 'required',
                    'id_types_equipement' => ''
                ]);

                Equipement::editEquipement($validatedData);

                return redirect()->route('admin.paramsEquipement');
            }
        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour modifier un champ supplémentaire
    public function editChamp($id, Request $request)
    {
        if(Auth::user()->admin == 1){
            if(empty($_POST)){

                $data['champ'] = $this->api->get('api/habitat/champ/'.$id);
                $data['typeBiensOfChamp'] = Champ_habitat::getTypeBienByChamp($id);

                $json  = json_encode($data['typeBiensOfChamp']);
                $data['typeBiensOfChamp'] = json_decode($json, true);


                $data['typeBiens'] = Habitat::getTypesHabitat();

                return view('admin.admin-edit-params-champ', $data);
            }else{

                $validatedData = $request->validate([
                    'nameFr' => 'required',
                    'nameEn' => 'required',
                    'typeChamp' => 'required',
                    'id_champ_habitat' => '',
                    'typeBien' => 'required'
                ]);

                Champ_habitat::editChamp($validatedData);

                $deleteChampPossede = Champ_habitat::deleteChampPossede($validatedData['id_champ_habitat']);

                if(!empty($_POST['typeBien'])){

                    if($_POST['typeBien'][0] == "All"){
                        $allTypeBien = Habitat::getTypesHabitat();

                        foreach($allTypeBien as $typeBien){
                            Champ_habitat::addChamp($typeBien->id_types_bien, $validatedData['id_champ_habitat']);
                        }
                    }else{
                        foreach($_POST['typeBien'] as $typeBien){
                            Champ_habitat::addChamp($typeBien, $validatedData['id_champ_habitat']);
                        }
                    }
                }


                return redirect()->route('admin.paramsChamps');
            }
        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour supprimer un commentaire
    public static function deleteCommentaire()
    {
        if(!empty($_POST)){
            $id_com = $_POST['id_commentaire'];

            $deleteCommentaire = Commentaires::deleteCommentaire($id_com);

            return redirect()->route('admin.commentaire');
        }else{
            return redirect()->route('admin.commentaire');
        }
    }

    //fonction pour supprimer une photo d'un commentaire
    public static function deletePhotoCommentaire()
    {
        if(!empty($_POST)){
            $id_commentaire_photo = $_POST['id_commentaire_photo'];

            $deleteCommentaire = Commentaire_Photo::deletePhoto($id_commentaire_photo);

            return redirect()->route('admin.photos');
        }else{
            return redirect()->route('admin.photos');
        }
    }

    //fonction pour afficher la page des types de bien
    public static function typeBien()
    {
        if(Auth::user()->admin == 1){

            $data['listeTypeBien'] = Habitat::getTypesHabitat();

            return view('admin.admin-type-bien', $data);

        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour modifier un type de bien
    public static function editTypeBien($id, Request $request)
    {
        if(Auth::user()->admin == 1){
            if(empty($_POST)){

                $data['typeBien'] =  Habitat::getTypeBien($id);

                $json  = json_encode($data['typeBien']);
                $data['typeBien'] = json_decode($json, true);

                return view('admin.admin-edit-type-bien', $data);
            }else{

                $validatedData = $request->validate([
                        'nameFr' => 'required',
                        'nameEn' => 'required',
                        'id_types_bien' => ''
                    ]);

                Habitat::editTypeBien($validatedData);


                if(!empty($_FILES)){

                    //upload de l'icone du type de bien
                    $photo = $request->file('images');

                    $file_name = 'type_bien_'.$_POST['id_types_bien'].'.png';


                    // on traite l'image puis on la sauvegarde (version vignettes)
                    Image::make($photo)
                    ->orientate()
                    ->fit(32, 32)
                    ->save(public_path('/img/type_bien/').''.$file_name);

                    Habitat::editIconTypeBien($_POST['id_types_bien'], $file_name);
                }

                return redirect()->route('admin.typeBien');
            }
        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour créer un type de bien
    public static function createTypeBien(Request $request)
    {
        if(Auth::user()->admin == 1){
            if(empty($_POST)){
                return view('admin.admin-create-type-bien');
            }else{

                $validatedData = $request->validate([
                    'nameFr' => 'required',
                    'nameEn' => 'required'
                ]);

                Habitat::createTypeBien($validatedData);
                $lastIdTypeBien = DB::getPdo()->lastInsertId();


                //upload de l'icone du type de bien
                $photo = $request->file('images');

                $file_name = 'type_bien_'.$lastIdTypeBien.'.'.$photo->getClientOriginalExtension();


                // on traite l'image puis on la sauvegarde (version vignettes)
                Image::make($photo)
                ->orientate()
                ->fit(32, 32)
                ->save(public_path('/img/type_bien/').''.$file_name);

                Habitat::addIconTypeBien($lastIdTypeBien, $file_name);

                return redirect()->route('admin.typeBien');
            }
        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour supprimer un type de bien
    public static function deleteTypeBien()
    {
        if(!empty($_POST)){
            $id_equipement = $_POST['id_types_bien'];

            $deleteTypeBien = Habitat::deleteTypeBien($id_equipement);

            return redirect()->route('admin.typeBien');
        }else{
            return redirect()->route('admin.typeBien');
        }
    }

    //fonction pour afficher les activités
    public function adminActivites()
    {
        if(Auth::user()->admin == 1){

            $data['allActivites'] = Activite::getAllActivites();


            return view('admin.admin-activite', $data);

        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour supprimer une activité
    public static function deleteActivite()
    {
        if(!empty($_POST)){
            $id_activites = $_POST['id_activites'];

            $deleteActivites = Activite::deleteActivite($id_activites);

            return redirect()->route('admin.activites');
        }else{
            return redirect()->route('admin.activites');
        }
    }

    //fonction pour afficher les factures
    public function adminFacturation()
    {
        if(Auth::user()->admin == 1){

            $data['allFacturations'] = Facturation::getAllFacturation();


            return view('admin.admin-facturation', $data);

        }else{
            return redirect()->route('accueil');
        }
    }

    //fonction pour supprimer une facturation
    public function deleteFacturation()
    {
        if(!empty($_POST)){
            $id_facturation = $_POST['id_facturation'];

            $deleteFacturation = Facturation::deleteFacturation($id_facturation);

            return redirect()->route('admin.facturation');
        }else{
            return redirect()->route('admin.facturation');
        }
    }

    //fonction pour afficher les données de l'entreprise Atypikhouse
    public function entreprise()
    {
        $data['entreprise'] = Entreprise::getEntreprise();

        return view('admin.admin-entreprise', $data);
    }

    //fonction pour modifier les données de l'entreprise Atypikhouse
    public function updateEntreprise(Request $request)
    {
        if(!empty($_POST)){

            $validatedData = $request->validate([
                    'nameFr' => 'required',
                    'description_fr' => 'required',
                    'description_en' => 'required',
                    'adresse' => 'required',
                    'ville' => 'required',
                    'code_postal' => 'required',
                    'telephone' => 'required'
                ]);

            Entreprise::updateEntreprise($validatedData);

            return redirect()->route('admin.entreprise');
        }else{
            return redirect()->route('admin.entreprise');
        }
    }
}
