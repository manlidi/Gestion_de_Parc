<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Demande;
use App\Models\Voiture;
use App\Models\Chauffeur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest()){
            return redirect('login');
        }
        $demande = Demande::all()->where('user_id', Auth::user()->id);
        return view('demandes.all', compact('demande'));
    }
    public function indexAdmin(){
        $demande = Demande::all()->where('status', 'Non Approuvée');
        return view('demandes.admindemandes', compact('demande'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $voiture = Voiture::all()->where('dispo', '=', 'Disponible');
        $chauffeur = Chauffeur::all()->where('disp', '=', 'Disponible');
        return view('demandes.add', compact('voiture', 'chauffeur'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $demande = new Demande();
        $demande->objetdemande = $request->objetdemande;
        $demande->datedeb = $request->datedeb;
        $demande->datefin = $request->datefin;
        $demande->voiture_id = $request->voiture_id;
        $demande->user_id = Auth::user()->id;

        if($request->check == "on"){
            $demande->chauffeur_id = $request->chauffeur_id;
        }else{
            $demande->chauffeur_id = NULL;
        }

        $status = $demande->save();

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Votre demande a été enregistré avec succès. Veuillez attendre sa validation!'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('demandes')->with($parametre);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function show(Demande $demande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function edit(Demande $demande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demande $demande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demande $demande)
    {
        //
    }
}
