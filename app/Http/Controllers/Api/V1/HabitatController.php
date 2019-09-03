<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Transformers\HabitatTransformer;
use App\Models\Habitat;
use App\Models\Equipement;
use App\Models\Champ_habitat;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;


class HabitatController extends Controller
{
    use Helpers;

    //fonction pour récupérer un habitat
    public function index($id_habitat)
    {
        $habitat = Habitat::findOrFail($id_habitat);
        return ($habitat);
    }

    //fonction pour récupérer les photos d'un habitat
    public function getPhotosHabitat($id_habitat)
    {
        $photosHabitat = Habitat::getPhotosHabitat($id_habitat);
        return ($photosHabitat);
    }

    //fonction pour récupérer les disponibilités d'un habitat
    public function getDisponibiliteHabitat($id_habitat)
    {
        $dispoHabitat = Habitat::getDisponibiliteHabitat($id_habitat);
        return ($dispoHabitat);
    }

    //fonction pour récupérer les équipement d'un habitat
    public function getEquipementHabitat($id_habitat)
    {
        $equipementHabitat = Habitat::getEquipementHabitat($id_habitat);
        return ($equipementHabitat);
    }

    //fonction pour récupérer tous les équipements
    public function getAllEquipements()
    {
        $allEquipementHabitat = Habitat::getAllEquipements();
        return ($allEquipementHabitat);
    }

    //fonction pour récupérer un équipement
    public function getEquipement($id)
    {
        $Equipement = Equipement::getEquipement($id);
        return ($Equipement);
    }

    //fonction pour récupérer un champ
    public function getChamp($id)
    {
        $Champ = Champ_habitat::getchamp($id);
        return ($Champ);
    }

    //fonction pour récupérer les type d'habitat
    public function getTypeHabitat()
    {
        $typesHabitat = Habitat::getTypesHabitat();
        return ($typesHabitat);
    }

    //fonction pour récupérer tous les habitats
    public function getAllHabitat(){
        $allHabitat = Habitat::getAllHabitat();
        return ($allHabitat);
    }

    //fonction pour récupérer un type de bien
    public function getTypeBien($id){
        $typeBien = Habitat::getTypeBien($id);
        return ($typeBien);
    }

}
