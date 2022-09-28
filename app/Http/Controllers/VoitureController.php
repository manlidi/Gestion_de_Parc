<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Voiture;
use App\Models\Piece;
use App\Models\Assurance;
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
        return view('voitures.add');
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
            'dureeVie' => 'required',
            'numchassis' => 'required',
            'etat' => 'required',
            'kilmax' => 'required',
            'connsommation' => 'required',
            'coutaquisition' => 'required',
        ]);

        $data = $request->all();
        $check = $this->show($data);

        $voiture = Voiture::all();
        return view('voitures.all', compact('voiture'));
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
            'dureeVie' => $data['dureeVie'],
            'numchassis' => $data['numchassis'],
            'etat' => $data['etat'],
            'kilmax' => $data['kilmax'],
            'connsommation' => $data['connsommation'],
            'coutaquisition' => $data['coutaquisition'],
        ]);
    }

    public function details($id){
        $nbr = DB::table('reparers')
            ->join('voitures', 'voitures.id', '=', 'reparers.voiture_id')
            ->select(DB::raw('count(*) as nombre'))
            ->where('voitures.id', '=', $id)
            ->get();
        $detail = DB::table('voitures')
            ->select('voitures.*')
            ->where('id', '=', $id)
            ->get();
        return view('voitures.details', compact('nbr','detail'));
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
