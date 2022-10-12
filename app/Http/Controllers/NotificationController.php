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

        return view('notification.all', compact('assurences', 'pieces'));
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
        $pieces = DB::table('pieces')
            ->join('voitures', 'voitures.id', '=', 'pieces.voiture_id')
            ->select('*')
            ->get();

        foreach($pieces as $piece){
            $date1 = new DateTime($piece->datefin);
            $jourRestant = $date2->diff($date1)->format("%a");
            if( $jourRestant <= 7 ){
                $datas += array( $piece->voiture_id => array($jourRestant, $piece->datefin) );
                $nom = $piece->nompiece;
            }
        }

        foreach( $datas as $id => $info ){
            $voiture = Voiture::find($id);
            $notifs += array($id => array('marque' => $voiture->marque, 'immatriculation' => $voiture->immatriculation, 'nompiece' => $nom, 'datefin' => $info[1], 'jourRestant' => $info[0]));
        }
        return $notifs;
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
