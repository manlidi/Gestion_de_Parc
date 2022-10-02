<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Voiture;
use App\Models\Reparer;
use App\Models\Piece;
use App\Models\Garage;

class ReparerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repare = DB::table('reparers')
            ->join('voitures', 'voitures.id', '=', 'reparers.voiture_id')
            ->join('garages', 'garages.id', '=', 'reparers.garage_id')
            ->join('demandes', 'demandes.id', '=', 'reparers.demande_id')
            ->where('status', '=', 'Approuvée')
            ->select('*')
            ->get();
        return view('reparer.all', compact('repare'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $garage = Garage::all();
        $voiture = Voiture::all();
        return view('reparer.add', compact('garage', 'voiture'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reparation = new Reparer();
        $reparation->garage_id = $request->garage_id;
        $reparation->voiture_id = $request->voiture_id;
        $reparation->piece_id = $request->piece_id;
        $reparation->panne = $request->panne;
        $reparation->datereparation = $request->datereparation;
        $status = $reparation->save();

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Membre affecter à la mission avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('listereparation')->with($parametre);
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
