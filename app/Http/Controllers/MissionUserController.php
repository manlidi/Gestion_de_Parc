<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\MissionUser;
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
        $voiture = DB::table('mission_users')
            ->join('voitures', 'voitures.id', '=', 'mission_users.voiture_id')
            ->join('missions', 'missions.id', '=', 'mission_users.mission_id')
            ->select('voitures.*')
            ->where('missions.id', '=', $id)
            ->get();

        $chauffeur = DB::table('mission_users')
            ->join('chauffeurs', 'chauffeurs.id', '=', 'mission_users.chauffeur_id')
            ->join('missions', 'missions.id', '=', 'mission_users.mission_id')
            ->join('voitures', 'voitures.id', '=', 'mission_users.voiture_id')
            ->select('chauffeurs.*', 'voitures.*')
            ->where('missions.id', '=', $id)
            ->get();

        $mission = Mission::find($id);
        return view('missions.allmissionuser', compact('mission', 'voiture', 'chauffeur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $chauffeur = Chauffeur::all()->where('disp', '=', 'Disponible');
        $mission = MissionUser::find($id);
        $voiture = DB::table('mission_users')
            ->join('voitures', 'voitures.id', '=', 'mission_users.voiture_id')
            ->join('missions', 'missions.id', '=', 'mission_users.mission_id')
            ->select('voitures.*')
            ->where('missions.id', '=', $id)
            ->get();
        return view('missions.addmissionchauffeurs', compact('mission', 'chauffeur', 'voiture'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $mission_chauffeur = MissionUser::all()->where('voiture_id', '=', $request->voiture_id);
        foreach($mission_chauffeur as $mc){
            $mission = DB::table('mission_users')
            ->where('id', '=', $mc->id, 'AND', 'mission_id', '=', $id, 'AND', 'voiture_id', '=', $request->voiture_id)
            ->select('id')
            ->get();
            foreach($mission as $r){
                $status = DB::table('mission_users')
                    ->where('id', $r->id)
                    ->update(['chauffeur_id' => $request->chauffeur_id]);
            }
        }

        $cva = DB::table('chauffeurs')
                    ->where('id', $request->chauffeur_id)
                    ->update(['disp' => 'Non Disponible']);

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Chauffeur affecter avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur de mise à jour'];
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
