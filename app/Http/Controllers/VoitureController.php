<?php

namespace App\Http\Controllers;

use App\Models\Piece;
use App\Models\Voiture;
use App\Models\Assurance;
use App\Models\Structure;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voiture = Voiture::all();
        return view('voitures.all', compact('voiture'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $structure = Structure::all();
        return view('voitures.add', compact('structure'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'marque' => 'required',
            'capacite' => 'required',
            'immatriculation' => 'required',
            'datdebservice' => 'required',
            'numchassis' => 'required',
            'etat' => 'required',
            'kilmax' => 'required',
            'connsommation' => 'required',
            'coutaquisition' => 'required',
            'structure_id' => 'required',
            'date_next_visite' => 'required'
        ]);

        $data = $request->all();
        $status = $this->show($data);

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Voiture enregistée avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('voitures')->with($parametre);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(array $data)
    {
        return Voiture::create([
            'marque' => $data['marque'],
            'capacite' => $data['capacite'],
            'immatriculation' => $data['immatriculation'],
            'datdebservice' => $data['datdebservice'],
            'numchassis' => $data['numchassis'],
            'etat' => $data['etat'],
            'kilmax' => $data['kilmax'],
            'connsommation' => $data['connsommation'],
            'coutaquisition' => $data['coutaquisition'],
            'structure_id' => $data['structure_id'],
            'date_next_visite' => $data['date_next_visite']
        ]);
    }

    public function details($id){
        $nbr = DB::table('reparers')
            ->join('voitures', 'voitures.id', '=', 'reparers.voiture_id')
            ->select(DB::raw('count(*) as nombre'))
            ->where('voitures.id', '=', $id)
            ->count();


        $detail = DB::table('voitures')
            ->select('voitures.*')
            ->where('id', '=', $id)
            ->get();
        foreach ($detail as $key) {
            $dateNaissance = $key->datdebservice;
            $aujourdhui = date("Y-m-d");
            $diff = date_diff(date_create($dateNaissance), date_create($aujourdhui));
            $age = $diff->format('%y');
            $mois = $diff->format('%m');
            $jour = $diff->format('%d');
        }

            $reparations = DB::table('reparers')
                ->where('voiture_id', $id)
                ->get();
            $pieces_reparees = array();
            foreach ($reparations as $reparation) {
                $pieces_serialized = $reparation->pieces;
                $pieces_array = unserialize($pieces_serialized);
                foreach ($pieces_array as $piece_id) {
                    if (!isset($pieces_reparees[$piece_id])) {
                        $piece_name = DB::table('pieces')->where('id', $piece_id)->value('nompiece');
                        $pieces_reparees[$piece_id] = array('nom' => $piece_name, 'number' => 1);
                    }
                    else {
                        $pieces_reparees[$piece_id]['number']++;
                    }
                }
            }
            //dd($pieces_reparees);
        return view('voitures.details', compact('nbr','detail', 'age', 'mois', 'jour', 'pieces_reparees'));
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

    public function piece($id)
    {
        $pieces = Piece::where('voiture_id', $id)->get()->pluck('id', 'nompiece')->toArray();
        return response()->json($pieces);
        // dd($communes);
    }
}
