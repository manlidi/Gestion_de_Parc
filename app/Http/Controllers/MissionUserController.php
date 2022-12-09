<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mission;
use App\Models\Voiture;
use App\Models\Chauffeur;
use App\Models\MissionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        $chauffeurAjouterMission = MissionUserController::chauffeurAjouterMission($id);
        $kmDebutAjouterMission = MissionUserController::kmDebutAjouterMission($id);
        $voitureRendu = MissionUserController::voitureRendu($id);

        $current_user_id = Auth::id();
        $userStructureId = User::find($current_user_id)->structure->id;

        $mission = Mission::find($id);
        return view('missions.allmissionuser', compact('mission', 'userStructureId', 'chauffeurAjouterMission', 'kmDebutAjouterMission', 'voitureRendu'));
    }

    public static function rendreVoiture($id)
    {
        $missions = Mission::find($id)->mission_users;
        $status = true;
        foreach ($missions as $mission) {
            $voiture = Voiture::find($mission->voiture->id);
            if ($voiture->mouvement == 'En mission') {
                if ($voiture->dispo != 'Disponible') {
                    $voiture->dispo = "Disponible";
                    $voiture->mouvement = "Au parc";
                    $status = $voiture->update();
                }
            }
            if ($mission->user_id != null) {
                $userId = User::find($mission->user_id)->chauffeur->id;
                $chauffeur = Chauffeur::find($userId);
                $chauffeur->disp = "Disponible";
                $chauffeur->update();
            }
        }

        $mission = Mission::find($id);
        $mission->rendre = true;
        $mission->update();

        return true;
    }


    public static function chauffeurAjouterMission($missionId)
    {
        $ajouter = true;
        $missions = Mission::find($missionId);
        foreach ($missions->mission_users as $mission) {
            if ($mission->user == null) $ajouter = false;
        }
        return $ajouter;
    }

    public static function kmDebutAjouterMission($missionId)
    {
        $ajouter = true;
        $missions = Mission::find($missionId);
        foreach ($missions->mission_users as $mission) {
            if ($mission->kmdeb == 0) {
                $ajouter = false;
            }
        }
        return $ajouter;
    }

    public static function voitureRendu($missionId)
    {
        $mission = Mission::find($missionId);
        if($mission->rendre == true){
            return true;
        }
        return false;
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
        foreach ($mission_chauffeur as $mc) {
            $mission = DB::table('mission_users')
                ->where('id', '=', $mc->id)
                ->where('mission_id', '=', $id)
                ->where('voiture_id', '=', $request->voiture_id)
                ->select('id')
                ->get();
            foreach ($mission as $r) {
                $status = DB::table('mission_users')
                    ->where('id', $r->id)
                    ->update(['user_id' => $request->chauffeur_id]);
            }
        }

        $cva = DB::table('chauffeurs')
            ->where('id', $request->chauffeur_id)
            ->update(['disp' => 'Non Disponible']);

        if ($status) $parametre = ['status' => true, 'msg' => 'Chauffeur affecter avec succès'];
        else $parametre = ['status' => false, 'msg' => 'Erreur de mise à jour'];
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
