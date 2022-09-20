<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\MissionUser;
use App\Models\MissionVoiture;
use App\Models\MissionChauffeur;
use App\Models\User;
use App\Models\Voiture;
use App\Models\Chauffeur;
use Illuminate\Support\Facades\Auth;

class MissionUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = DB::table('mission_users')
            ->join('users', 'users.id', '=', 'mission_users.user_id')
            ->join('missions', 'missions.id', '=', 'mission_users.mission_id')
            ->select('users.name')
            ->where('missions.id', '=', $id)
            ->get();

        $voiture = DB::table('mission_voitures')
            ->join('voitures', 'voitures.id', '=', 'mission_voitures.voiture_id')
            ->join('missions', 'missions.id', '=', 'mission_voitures.mission_id')
            ->select('voitures.marque')
            ->where('missions.id', '=', $id)
            ->get();

        $chauffeur = DB::table('mission_chauffeurs')
            ->join('chauffeurs', 'chauffeurs.id', '=', 'mission_chauffeurs.chauffeur_id')
            ->join('missions', 'missions.id', '=', 'mission_chauffeurs.mission_id')
            ->select('chauffeurs.*')
            ->where('missions.id', '=', $id)
            ->get();

        $mission = Mission::find($id);
        //$mission->with('users')->get();
        //dd($mission);
        return view('missions.allmissionuser', compact('user', 'mission', 'voiture', 'chauffeur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //->where('structure_id', '=', Auth::user()->structure_id)
        $user = DB::table('users')->get();
        $mission = Mission::find($id);
        return view('missions.addmissionuser', compact('mission', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mission_user = new MissionUser();
        $mission_user->mission_id = $request->mission_id;
        $mission_user->user_id = $request->user_id;
        $status = $mission_user->save();

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Membre affecter à la mission avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('missions')->with($parametre);
    }

    public function save(Request $request){

        $mission_voiture = new MissionVoiture();
        $mission_voiture->mission_id = $request->mission_id;
        $mission_voiture->voiture_id = $request->voiture_id;
        $mission_voiture->kmdeb = $request->kmdeb;
        $status = $mission_voiture->save();

        $v = Voiture::find($mission_voiture->voiture_id);
        $v = DB::table('voitures')->where('id', $mission_voiture->voiture_id)->update(['dispo' => 'Indisponible', 'mouvement' => 'En mission']);

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Voiture affecter à la mission avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('missions')->with($parametre);
    }

    public function savechauffeur(Request $request){
        $mission_chauffeur = new MissionChauffeur();
        $mission_chauffeur->mission_id = $request->mission_id;
        $mission_chauffeur->chauffeur_id = $request->chauffeur_id;
        $status = $mission_chauffeur->save();

        $ch = Chauffeur::find($mission_chauffeur->chauffeur_id);
        $ch = DB::table('chauffeurs')->where('id', $mission_chauffeur->chauffeur_id)->update(['disp' => 'Indisponible']);

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Chauffeur affecter à la mission avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('missions')->with($parametre);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voiture = DB::table('voitures')->get();
        $mission = Mission::find($id);
        return view('missions.addmissionvoiture', compact('mission', 'voiture'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chauffeur = DB::table('chauffeurs')->get();
        $mission = Mission::find($id);
        return view('missions.addmissionchauffeurs', compact('mission', 'chauffeur'));
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
