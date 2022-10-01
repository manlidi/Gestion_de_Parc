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

    public function rendreVoiture( $id, $voiture=null, $missionUserId=null ){
        if( $voiture != null ){
            $voiture = Voiture::find($voiture);
            $voiture->dispo = "Disponible";
            $voiture->mouvement = "Au parc";
            $voiture->update();

            $chauffeurId = MissionUser::find($missionUserId)->chauffeur_id;
            $chauffeur = Chauffeur::find($chauffeurId);
            $chauffeur->disp = "Disponible";
            $chauffeur->update();
            
            $parametre = ['status'=>true, 'msg'=>'Les voitures ont été rendue avec succès'];
            return redirect()->route('det',['id'=>$id])->with($parametre);
        }else{
            $missions = Mission::find($id)->mission_users;
            $status = true;
            foreach( $missions as $mission ){
                $voiture = Voiture::find($mission->voiture->id);
                if( $voiture->dispo != 'Disponible' ){
                    $voiture->dispo = "Disponible";
                    $voiture->mouvement = "Au parc";
                    $status = $voiture->update();
                }
                if( $mission->chauffeur_id != null ){
                    $chauffeur = Chauffeur::find($mission->chauffeur_id);
                    $chauffeur->disp = "Disponible";
                    $chauffeur->update();
                }
                if( ! $status ){
                    $parametre = ['status'=>true, 'msg'=>'Erreur lors de la soumission'];
                    return redirect()->route('det',['id'=>$id])->with($parametre);
                }
            }
            $parametre = ['status'=>true, 'msg'=>'Les voitures ont été rendue avec succès'];
            return redirect()->route('missions')->with($parametre);
        }
    }

    public function addKmDebut( Request $request, $id ){
        $voitures = $request['voiture'];
        $status=true;
        foreach( $voitures as $voiture ){
            $mUser = MissionUser::find($voiture);
            $mUser->kmdeb = $request[$voiture];
            $status = $mUser->update();

            if( ! $status ){
                $parametre = ['status'=>true, 'msg'=>'Erreur lors de la soumission'];
                return redirect()->route('det',['id'=>$id])->with($parametre);
            }
        }

        $parametre = ['status'=>true, 'msg'=>'Kilométrage de début ajouté avec succès'];
        return redirect()->route('det',['id'=>$id])->with($parametre);
    }

    public function addChauffeure( Request $request, $id ){
        $missions = $request['chauffeur'];
        $status=true;
        foreach( $missions as $mission ){
            $mUser = MissionUser::find($mission);
            if( $request[$mission] != null ){
                $mUser->chauffeur_id = $request[$mission];
                $status = $mUser->update();

                $chauffeur = Chauffeur::find($request[$mission]);
                $chauffeur->disp = "Non Disponible";
                $chauffeur->update();

                if( ! $status ){
                    $parametre = ['status'=>true, 'msg'=>'Erreur lors de la soumission'];
                    return redirect()->route('det',['id'=>$id])->with($parametre);
                }
            }
        }
        $parametre = ['status'=>true, 'msg'=>'Chauffeur ajouté avec succès'];
        return redirect()->route('det',['id'=>$id])->with($parametre);
    }


    public static function chauffeurAjouterMission( $missionId ){
        $ajouter = true;
        $missions = Mission::find($missionId);
        foreach( $missions->mission_users as $mission ){
            if( $mission->chauffeur == null ) $ajouter = false;
        }
        return $ajouter;
    }

    public static function kmDebutAjouterMission( $missionId ){
        $ajouter = true;
        $missions = Mission::find($missionId);
        foreach( $missions->mission_users as $mission ){
            if( $mission->kmdeb == 0 ){ $ajouter = false; }
        }
        return $ajouter;
    }

    public static function voitureRendu( $missionId ){
        $rendre = true;
        $missions = Mission::find($missionId);
        foreach( $missions->mission_users as $mission ){
            if( $mission->voiture->dispo == 'Non Disponible' ){ $rendre = false; }
        }
        return $rendre;
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
