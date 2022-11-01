<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Assurance;
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

        return view('notification.all', compact('assurences', 'pieces', 'visites'));
    }

    public static function assuranceNotif(){
        $date2 = new DateTime(date('Y-m-d'));
        $datas = array();
        $notifs = array();
        $assurances = Assurance::all()
            ->where('status','=',true );

        foreach($assurances as $assurance){
            $date1 = new DateTime($assurance->datefinA);
            $jourRestant = $date2->diff($date1)->format("%a");
            if( $jourRestant <= 7 ){
                $datas += array( $assurance->voiture_id => array($jourRestant, $assurance->datefinA) );
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
                    $datas += array( $piece->id => array($jourRestant, $piece->datefin, $piece->nompiece, $piece->voiture_id) );
                }
            }else{
                $datas += array( $piece->id => array(($jourRestant/(-1)), $piece->datefin, $piece->nompiece, $piece->voiture_id) );
            }
        }

        foreach( $datas as $id => $info ){
            $voiture = Voiture::find($info[3]);
            $notifs += array($id => array('marque' => $voiture->marque, 'immatriculation' => $voiture->immatriculation, 'datefin' => $info[1], 'jourRestant' => $info[0], 'nompiece' =>$info[2]));
        }
        return $notifs;
    }

    public static function visiteNotif(){
        $voitures = Voiture::all()
            ->where('status_visite','=',false)
            ->where('kmvidange', '>=', 1000);

        return $voitures;
    }
}
