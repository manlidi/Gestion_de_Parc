<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use App\Models\Demande;
use App\Models\Voiture;
use App\Models\Chauffeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function createVoiture()
    {
        $authorId = Auth::id();
        $id = User::find($authorId)->structure->id;
        $voiture = Voiture::all()->where('dispo', '=', 'Disponible', 'AND', 'structure_id', '=', $id);
        $chauffeur = Chauffeur::all()->where('disp', '=', 'Disponible', 'AND', 'structure_id', '=', $id);
        return view('demandes.addVoiture', compact('voiture', 'chauffeur'));
    }

    public function createChauffeur()
    {
        $authorId = Auth::id();
        $id = User::find($authorId)->structure->id;
        $chauffeur = Chauffeur::all()->where('disp', '=', 'Disponible', 'AND', 'structure_id', '=', $id);
        return view('demandes.addChauffeur', compact('chauffeur'));
    }

    public function createReparation(){
        return "ok";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type)
    {
        if( $type == 'voiture' ){
            $status = self::saveModel($request, $type, $request->voiture_id);

            if($request->check == "on"){
                self::saveModel($request, 'chauffeur');
            }
        }
        if( $type == 'chauffeur' ){
            $status = self::saveModel($request, $type);
        }

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Votre demande a été enregistré avec succès. Veuillez attendre sa validation!'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('dashboard')->with($parametre);
    }

    public static function saveModel($request, $type, $affection=null){
        $demande = new Demande();
        $demande->objetdemande = $request->objetdemande;
        $demande->datedeb = $request->datedeb;
        $demande->datefin = $request->datefin;
        if( $affection != null ){
            $demande->affecter_id = $affection;
        }else{
            $demande->affecter_id = $request->chauffeur_id;
        }
        $demande->type = $type;
        $demande->user_id = Auth::user()->id;
        $status = $demande->save();
        return $status;
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
    public function edit($id)
    {
        $demandes = Demande::find($id);
        $authorId = Auth::id();
        $id = User::find($authorId)->structure->id;
        $voiture = Voiture::all()->where('dispo', '=', 'Disponible', 'AND', 'structure_id', '=', $id);
        $chauffeur = Chauffeur::all()->where('disp', '=', 'Disponible', 'AND', 'structure_id', '=', $id);

        return view('demandes.edit', compact('demandes','voiture', 'chauffeur'));
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
