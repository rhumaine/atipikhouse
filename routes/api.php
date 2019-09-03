<?php

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


$api = app(Router::class);

//routes non authentifiées
$api->version('v1', [], function (Router $api) {
    //récupère les activités
    $api->get('activite', 'App\Http\Controllers\Api\V1\ActiviteController@index');

    // récupère un habitat
    $api->get('habitat/{id_habitat}', 'App\Http\Controllers\Api\V1\HabitatController@index')->where('id_habitat','[0-9]+');

    // récupère les photos d'un habitat
    $api->get('habitat/photos/{id_habitat}', 'App\Http\Controllers\Api\V1\HabitatController@getPhotosHabitat')->where('id_habitat','[0-9]+');

    // récupère les disponibilités d'un habitat
    $api->get('habitat/disponibilite/{id_habitat}', 'App\Http\Controllers\Api\V1\HabitatController@getDisponibiliteHabitat')->where('id_habitat','[0-9]+');

    // récupère les équipements d'un habitat
    $api->get('habitat/equipement/{id_habitat}', 'App\Http\Controllers\Api\V1\HabitatController@getEquipementHabitat')->where('id_habitat','[0-9]+');

    // récupère tous les équipements
    $api->get('habitat/equipement', 'App\Http\Controllers\Api\V1\HabitatController@getAllEquipements');

    // récupère un équipement
    $api->get('habitat/equipements/{id}', 'App\Http\Controllers\Api\V1\HabitatController@getEquipement')->where('id','[0-9]+');

    // récupère un champ
    $api->get('habitat/champ/{id}', 'App\Http\Controllers\Api\V1\HabitatController@getChamp')->where('id','[0-9]+');

    // récupère tous les habitats
    $api->get('habitat/all', 'App\Http\Controllers\Api\V1\HabitatController@getAllHabitat');

    // récupère tous les types d'habitats
    $api->get('habitat/typeHabitat', 'App\Http\Controllers\Api\V1\HabitatController@getTypeHabitat');

    // poste un habitat
    $api->post('habitat/add', 'App\Http\Controllers\Api\V1\HabitatController@addHabitat');

    // login
    $api->post('login', 'App\Http\Controllers\Api\V1\AuthController@login');

    // récupère les réservations d'un habitat
    $api->get('reservation/{id_habitat}', 'App\Http\Controllers\Api\V1\ReservationController@getResa')->where('id_habitat','[0-9]+');

});

//routes authentifiées
$api->version('v1', ['middleware' => 'api.auth'], function (Router $api) {
    //recupere les données de l'utilisateur connecté
    $api->get('userdata', 'App\Http\Controllers\Api\V1\UserController@userdata');
    
    //on récupère les reservations du user connecté
    $api->get('recapresa', 'App\Http\Controllers\Api\V1\ReservationController@recapitulatif');
    
    //on récupere le commentaire eventuel d'une reservation
    $api->get('recupcomm/{id_resa}', 'App\Http\Controllers\Api\V1\CommentairesController@recup')->where('id_resa','[0-9]+');
    
    //on récupere les photos du commentaire
    $api->get('recupcommphoto/{id_resa}', 'App\Http\Controllers\Api\V1\CommentairesController@recupphoto')->where('id_resa','[0-9]+');

    //poster un commentaire pour une réservation donnée
    $api->post('postcomm/{id_resa}', 'App\Http\Controllers\Api\V1\CommentairesController@poster')->where('id_resa','[0-9]+');
    
    //poster une photo pour une réservation donnée
    $api->post('postphoto/{id_resa}', 'App\Http\Controllers\Api\V1\CommentairesController@posterphoto')->where('id_resa','[0-9]+');
    
});

