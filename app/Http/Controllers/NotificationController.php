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

    public function vidangeNotif(){
        $voitures = Voiture::all()->where('kilmax', '>', 900)->where('kilmax', '<=', 1000);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
