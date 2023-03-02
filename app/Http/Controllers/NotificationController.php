<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Assurance;
use App\Models\Demande;
use App\Models\Notification;
use App\Models\Piece;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $assurences = self::assuranceNotif();
        $pieces = self::pieceNotif();
        $visites = self::visiteNotif();
        $vidanges = self::vidangeNotif();
        $demandes = self::rendreVehicule();

        return view('notification.all', compact('assurences', 'pieces', 'visites', 'vidanges', 'demandes'));
    }

    public static function assuranceNotif(){
        $date2 = new DateTime(date('Y-m-d'));
        $datas = array();
        $notifs = array();
        $assurances = Assurance::where('status','=',true )->get();

        foreach($assurances as $assurance){
            $date1 = new DateTime($assurance->datefinA);
            $jourRestant = $date2->diff($date1)->format("%a");
            if( $date2 < $date1 ){
                if( $jourRestant <= 7 ){
                    $datas += array( $assurance->voiture_id => array($jourRestant, $assurance->datefinA) );
                }
            }else{
                $datas += array( $assurance->voiture_id => array(($jourRestant/(-1)), $assurance->datefinA) );
            }
        }

        foreach( $datas as $id => $info ){
            $voiture = Voiture::find($id);
            $notifs += array($id => array('marque' => $voiture->marque, 'immatriculation' => $voiture->immatriculation, 'datefinA' => $info[1], 'jourRestant' => $info[0]));
        }
        return $notifs;
    }

    public static function pieceNotif(){
        $date2 = new DateTime(date('Y-m-d'));
        $datas = array();
        $notifs = array();

        $pieces = Piece::all();

        foreach($pieces as $piece){
            $date1 = new DateTime($piece->datefin);
            $jourRestant = $date2->diff($date1)->format("%a");
            if( $date2 < $date1 ){
                if( $jourRestant <= 7 ){
                    $datas += array( $piece->id => array($jourRestant, $piece->datefin, $piece->nompiece) );
                }
            }else{
                $datas += array( $piece->id => array(($jourRestant/(-1)), $piece->datefin, $piece->nompiece) );
            }
        }

        foreach( $datas as $id => $info ){
            $notifs += array($id => array('datefin' => $info[1], 'jourRestant' => $info[0], 'nompiece' =>$info[2]));
        }
        return $notifs;
    }

    public static function visiteNotif(){
        $date2 = new DateTime(date('Y-m-d'));
        $datas = array();
        $voitures = Voiture::all()
            ->where('status_visite','=',false);

        foreach($voitures as $voiture){
            $date1 = new DateTime($voiture->date_next_visite);
            $jourRestant = $date2->diff($date1)->format("%a");

            if( $date2 < $date1 ){
                if( $jourRestant <= 7 ){
                    $datas += array( $voiture->id => array('marque' => $voiture->marque, 'immatriculation' => $voiture->immatriculation, 'date_next_visite' => $voiture->date_next_visite, 'jourRestant' => $jourRestant) );
                }
            }else{
                $datas += array( $voiture->id => array('marque' => $voiture->marque, 'immatriculation' => $voiture->immatriculation, 'date_next_visite' => $voiture->date_next_visite, 'jourRestant' => ($jourRestant/(-1))) );
            }
        }
        return $datas;
    }

    public static function rendreVehicule(){
        $date = new DateTime(date('Y-m-d'));
        $datas = array();

        $demandes = DB::table('demandes')
        ->join('users', 'users.id', '=', 'demandes.user_id')
        ->select('*')
        ->where('status', '=', 'Approuvée')
        ->get();//Demande::all()->where('status', '=', 'Approuvée');
        foreach($demandes as $demande){
            $date1 = new DateTime($demande->datefin);

            if($date > $date1){
                $datas += array( $demande->id => array('objetdemande' => $demande->objetdemande, 'name' => $demande->name, 'datefin' => $demande->datefin) );
            }
        }
        return $datas;
    }

    public function vidangeNotif(){
        $voitures = Voiture::all()
            ->where('status_vidange','=',false)
            ->where('kmvidange', '>=', 1000);
        return $voitures;
    }
}
