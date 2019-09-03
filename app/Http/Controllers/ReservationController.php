<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Habitat;
use App\Models\Reservation;
use App\Models\Facturation;
use App\Models\User;
use Dingo\Api\Routing\Helpers;
use App\Mail\ReservationRefuse;
use App\Mail\ReservationAccepte;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;


class ReservationController extends Controller
{
    use Helpers;

    private $_api_context;

    //fonction appelé à chaque appel de function dans ce controller
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    //fonction pour afficher afficher la page de récapitulatif d'une réservation
    public function index($id)
    {
        if(!empty($_POST)){
            $data['detailHabitat'] = $this->api->get('api/habitat/'.$id);

            list($day, $month, $year) = explode("-", $_POST['date-start']);
            $months = array("janvier", "février", "mars", "avril", "mai", "juin","juillet", "août", "septembre", "octobre", "novembre", "décembre");
            $date_start = $day." ".$months[$month-1]." ".$year;

            list($day, $month, $year) = explode("-", $_POST['date-end']);

            $date_end = $day." ".$months[$month-1]." ".$year;

            $data['date_start'] = $date_start;
            $data['date_end'] = $date_end;

            $date_start = strtotime($_POST['date-start']);
            $date_end = strtotime($_POST['date-end']);


            // On récupère la différence de timestamp entre les 2 précédents
            $nbJoursTimestamp = $date_end - $date_start;

            // ** Pour convertir le timestamp (exprimé en secondes) en jours **
            // On sait que 1 heure = 60 secondes * 60 minutes et que 1 jour = 24 heures donc :
            $data['nbJours'] = $nbJoursTimestamp/86400; // 86 400 = 60*60*24

            $arrivee = explode(':',$data['detailHabitat']['heure_arrivee_habitat']);

            $data['heureArrivee'] = $arrivee[0];
            $data['minuteArrivee'] = $arrivee[1];

            //$dispo = $this->api->get('api/habitat/disponibilite/'.$id);
            $dispo =  Habitat::getDisponibiliteResa($id, date('Y-m-d', strtotime($_POST['date-start'])));
            $dispo = json_decode($dispo, true);
            if(!empty($dispo)){
                $data['dispoHabitat'] = $dispo;

                $data['prixTotal'] = $data['nbJours']*$dispo[0]['prix_disponibilites'];

                $data['equipementHabitat'] = $this->api->get('api/habitat/equipement/'.$id);

                \Session::put('date_debut', $_POST['date-start']);
                \Session::put('date_end', $_POST['date-end']);
                \Session::put('id_habitat', $id);
                \Session::put('id_user', Auth::user()->id);
                \Session::put('prix_resa', $data['prixTotal']);

                return view('reservationHabitat', $data);

            }else{
                return redirect()->route('detailhabitat', ['id' => $id]);
            }
        }else{
            return redirect()->route('detailhabitat', ['id' => $id]);
        }

    }

    //fonction pour accepter une réservation
    public function accepterReservation($id){
        $resa = Reservation::getResaById($id);
        $json  = json_encode($resa);
        $resa = json_decode($json, true);

        $payment_id = $resa[0]['paymentId'];
        $payerID = $resa[0]['PayerID'];

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerID);
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
             Reservation::accepterReservation($id);

        }

        Facturation::updateFacturation($id);
        //envoi d'un mail à la personne qui a souhaité reserver
        Mail::to('lukesky4778@gmail.com')->queue(new ReservationAccepte());

        return redirect()->route('reservations.validation');
    }

    //fonction pour refuser une réservation
    public function refuserReservation($id){


        //passer la reservation en refusé
        Reservation::annulerReservation($id);

        Facturation::deleteFacturationByResa($id);
        //envoi d'un mail à la personne qui a souhaité reserver
        Mail::to('lukesky4778@gmail.com')->queue(new ReservationRefuse());

        return redirect()->route('reservations.validation');
    }

    //fonction appelée au retour OK de paypal
    public function paypalAccepted(){

        $date_debut = Session::get('date_debut');

        list($day, $month, $year) = explode("-", $date_debut);

        $date_debut = $year."-".$month."-".$day;

        $date_end = Session::get('date_end');

        list($day, $month, $year) = explode("-", $date_end);

        $date_end = $year."-".$month."-".$day;

        $id_user = Session::get('id_user');
        $id_habitat = Session::get('id_habitat');
        $prix_resa = Session::get('prix_resa');


        $data = array('date_debut_reservation' =>$date_debut, 'date_fin_reservation' =>$date_end,'id_user' =>$id_user,'id_habitat' =>$id_habitat, 'prix' => $prix_resa, 'paymentId' => $_GET['paymentId'], 'token' => $_GET['token'], 'PayerID' => $_GET['PayerID']);

        Reservation::addReservation($data);
        $id_resa = DB::getPdo()->lastInsertId();


        /* AJOUT DE LA FACTURE */
        $date_debut_str = strtotime($date_debut);
        $date_end_str = strtotime($date_end);

        $nbJoursTimestamp = $date_end_str - $date_debut_str;

        $nbJours = $nbJoursTimestamp/86400;

        $dataHabitat = Habitat::findOrFail($id_habitat);

        $dataBailleur = User::getBailleur($dataHabitat['id_user']);
        $dataBailleur = json_decode($dataBailleur, true);

        Facturation::addfacturation($id_habitat, $date_debut, $date_end, $prix_resa, $nbJours, $dataHabitat, $dataBailleur[0], $id_resa);

        return view('reservationAccepted');
    }

    //fonction appelée au retour KO de paypal
    public function paypalCancelled(){
        return view('reservationCancelled');
    }
}







