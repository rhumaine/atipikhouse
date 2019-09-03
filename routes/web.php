<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

// route accueil
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@index')->name('accueil');

// route faq
Route::get('/faq', function () {
    return view('faq');
});

//routes login social
Route::get('{provider}', 'Auth\SocialController@redirect')->where('provider', '(facebook|google)');
Route::get('{provider}/callback', 'Auth\SocialController@callback')->where('provider', '(facebook|google)');

// route page contact
Route::get('/contact', 'ContactController@index')->name('contact');

// page mentions légales
Route::get('/mentions-legales', function () {
    return view('mentions_legales');
})->name('mentions');


//recherche
Route::get('/recherche', 'HabitatController@search')->name('recherche');

//habitat
Route::get('/habitat/{id}', 'HabitatController@index')->name('detailhabitat')->where('id', '[0-9]+');
Route::any('/habitat/{id}/reservation', 'ReservationController@index')->name('reservationHabitat')->where('id', '[0-9]+')->middleware('auth');
Route::get('/habitat/creer', 'HabitatController@create')->name('habitat.create')->middleware('auth');
Route::get('/habitat/{id}/modifier', 'HabitatController@modify')->name('habitat.modify')->middleware('auth');
Route::post('/habitat/{id}/update', 'HabitatController@update')->name('habitat.update')->middleware('auth');
Route::get('/habitat/getChamps/{id}', 'HabitatController@getChamps')->where('id', '[0-9]+')->middleware('auth');
Route::get('/habitat/supprimerPhoto/{id}', 'HabitatController@supprimerPhoto')->where('id', '[0-9]+')->middleware('auth')->name('supprimerPhoto');
Route::post('/habitat/add', 'HabitatController@store')->name('habitat.store')->middleware('auth');
Route::any('/habitats/{id}/disponibilites', 'HabitatController@getHabitatDispo')->name('habitat.getdispo')->where('id', '[0-9]+')->middleware('auth');
Route::any('/habitats/{id}/disponibilites/add', 'HabitatController@habitatDispo')->name('habitat.dispo')->middleware('auth');
Route::any('/habitats/addDisponibilites', 'HabitatController@habitatAddDispo')->name('habitat.dispoAdd')->middleware('auth');
Route::any('/habitats/deleteDisponibilites', 'HabitatController@deleteHabitatDispo')->name('habitat.deleteDispo')->middleware('auth');

//commentaire
Route::any('/commentaire/poster', 'CommentaireController@poster')->name('commentaire.poster')->middleware('auth');

//activite
//Route::get('/activite', 'ActiviteController@test');
Route::get('/activite/creer', 'ActiviteController@index')->name('activite.create')->middleware('auth');
Route::post('/activite/add', 'ActiviteController@creer')->name('activite.store')->middleware('auth');
Route::get('/activite/{id}', 'ActiviteController@detail')->name('detailactivite')->where('id', '[0-9]+')->middleware('auth');

Route::get('/activite/{id}/modifier', 'ActiviteController@modify')->name('activite.modify')->middleware('auth');
Route::post('/activite/{id}/update', 'ActiviteController@update')->name('activite.update')->middleware('auth');

//account
Route::get('/account/profil', 'UserController@account')->name('user.profil')->middleware('auth');
Route::get('/account/habitats', 'UserController@habitats')->name('user.habitats')->middleware('auth');
Route::get('/account/activites', 'UserController@activites')->name('user.activites')->middleware('auth');
Route::get('/account/reservations', 'UserController@reservations')->name('user.reservations')->middleware('auth');
Route::get('/account/reservations/validation', 'UserController@reservationsValidation')->name('reservations.validation')->middleware('auth');
Route::get('/account/profil/edit', 'UserController@edit')->name('user.edit')->middleware('auth');
Route::post('/account/profil/update', 'UserController@update')->name('user.update')->middleware('auth');

//reservation
Route::get('/reservation/{id}/refus', 'ReservationController@refuserReservation')->name('reservation.refus')->where('id', '[0-9]+')->middleware('auth');
Route::get('/reservation/{id}/accepte', 'ReservationController@accepterReservation')->name('reservation.accepte')->where('id', '[0-9]+')->middleware('auth');

/***** ROUTES DE L'ADMINISTRATION *****/
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');
Route::any('/admin/users', 'AdminController@users')->name('admin.users')->middleware('auth');

Route::any('/admin/entreprise', 'AdminController@entreprise')->name('admin.entreprise')->middleware('auth');
Route::any('/admin/entreprise/update', 'AdminController@updateEntreprise')->name('admin.updateEntreprise')->middleware('auth');


Route::any('/admin/facturation', 'AdminController@adminFacturation')->name('admin.facturation')->middleware('auth');
Route::any('/admin/facturation/delete', 'AdminController@deleteFacturation')->name('admin.deleteFacturation')->middleware('auth');

Route::any('/admin/types-bien', 'AdminController@typeBien')->name('admin.typeBien')->middleware('auth');
Route::any('/admin/types-bien/{id}/edit', 'AdminController@editTypeBien')->name('admin.editTypeBien')->where('id', '[0-9]+')->middleware('auth');
Route::any('/admin/types-bien/add', 'AdminController@createTypeBien')->name('admin.createTypeBien')->middleware('auth');
Route::any('/admin/types-bien/delete', 'AdminController@deleteTypeBien')->name('admin.deleteTypeBien')->middleware('auth');

Route::get('/admin/parameters', 'AdminController@paramsHabitats')->name('admin.params')->middleware('auth');
Route::get('/admin/parameters/equipements', 'AdminController@paramsEquipementHabitats')->name('admin.paramsEquipement')->middleware('auth');
Route::any('/admin/parameters/equipements/add', 'AdminController@createEquipement')->name('admin.createEquipement')->middleware('auth');
Route::any('/admin/parameters/equipements/{id}/edit', 'AdminController@editEquipement')->name('admin.editEquipement')->where('id', '[0-9]+')->middleware('auth');
Route::any('/admin/parameters/equipements/delete', 'AdminController@deleteEquipement')->name('admin.deleteEquipement')->middleware('auth');

Route::get('/admin/parameters/champs', 'AdminController@paramsChampsHabitats')->name('admin.paramsChamps')->middleware('auth');
Route::any('/admin/parameters/champs/add', 'AdminController@createChamp')->name('admin.createChamp')->middleware('auth');
Route::any('/admin/parameters/champs/{id}/edit', 'AdminController@editChamp')->name('admin.editChamp')->where('id', '[0-9]+')->middleware('auth');
Route::any('/admin/parameters/champ/delete', 'AdminController@deleteChamp')->name('admin.deleteChamp')->middleware('auth');

Route::get('/admin/commentaires', 'AdminController@commentairesHabitats')->name('admin.commentaire')->middleware('auth');
Route::any('/admin/commentaires/delete', 'AdminController@deleteCommentaire')->name('admin.deleteCommentaire')->middleware('auth');

Route::get('/admin/photos', 'AdminController@photoCommentaire')->name('admin.photos')->middleware('auth');
Route::any('/admin/photos/delete', 'AdminController@deletePhotoCommentaire')->name('admin.photosDelete')->middleware('auth');

Route::any('/admin/users/delete', 'AdminController@supprimerUser')->name('admin.supprimer')->middleware('auth');

Route::get('/admin/activites', 'AdminController@adminActivites')->name('admin.activites')->middleware('auth');
Route::any('/admin/activites/delete', 'AdminController@deleteActivite')->name('admin.deleteActivite')->middleware('auth');


// routes de réservation
Route::any('/reservation/paiement', 'PaymentController@payWithpaypal')->name('reservation.paypalPaiement')->middleware('auth');
Route::any('/reservation/accepted', 'ReservationController@paypalAccepted')->name('reservation.paypalAccepted')->middleware('auth');
Route::any('/reservation/cancelled', 'ReservationController@paypalCancelled')->name('reservation.paypalCancelled')->middleware('auth');


