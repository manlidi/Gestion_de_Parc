<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Voiture;
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
        $assur = Assurance::all();
        return view('voitures.add', compact('assur'));
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
            'assurance_id' => 'required',
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
            'assurance_id' => $data['assurance_id']
        ]);
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
