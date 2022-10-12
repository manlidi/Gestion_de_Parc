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
        return view('notification.all', compact('assurences','visites','pieces'));

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
        $week=date("Y-m-d", strtotime ("+1 week"));
        $today=date("Y-m-d");
        $datas = array();
        $notifs = array();

        $pieces = Piece::all()->where('datefin', '>', $today, 'AND', 'datefin', '<', $week);

        foreach($pieces as $piece){
            $datas += array( $piece->voiture_id => array($piece->datefin, $piece->voiture_id) );
            $nom = $piece->nompiece;
        }
        dd($datas);

        foreach( $datas as $id => $info ){
            $voiture = Voiture::find($id);
            $notifs += array($id => array('marque' => $voiture->marque, 'immatriculation' => $voiture->immatriculation, 'nompiece' => $nom, 'datefin' => $info[0]));
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
            if( $jourRestant <= 7 ){
                $datas += array( $voiture->id => array('marque' => $voiture->marque, 'immatriculation' => $voiture->immatriculation, 'date_next_visite' => $voiture->date_next_visite, 'jourRestant' => $jourRestant) );
            }
        }
        return $datas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
