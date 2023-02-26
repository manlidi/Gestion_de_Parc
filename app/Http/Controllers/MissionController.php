<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mission;
use App\Models\Voiture;
use App\Models\Chauffeur;
use App\Models\Demande;
use App\Models\MissionUser;
use App\Models\Piece;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::finishMission();
        $mission = Mission::all();
        return view('missions.all', compact('mission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $voiture = Voiture::all()
            ->where('dispo', '=', 'Disponible')
            ->where('structure_id','=',User::find(Auth::user()->id)->structure_id);
        return view('missions.add', compact('voiture'));
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
            'objetmission' => 'required',
            'datedeb' => 'required',
            'datefin' => 'required',
            'voitures' => 'required',
            'datefin'    =>  'required|date|after:datedeb'
        ]);

        $data = $request->all();

        $status = $this->show($data);

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Mission enregistrée avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('missions')->with($parametre);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show(array $data)
    {
        $mission = Mission::create([
            'objetmission' => $data['objetmission'],
            'datedeb' => $data['datedeb'],
            'datefin' => $data['datefin']
        ]);

        $voitures = $data['voitures'];
        foreach( $voitures as $voiture ){
            MissionUser::create([
                'voiture_id' => $voiture,
                'mission_id' => $mission->id
            ]);

            $cva = DB::table('voitures')
                    ->where('id', $voiture)
                    ->update(['dispo' => 'Non Disponible', 'mouvement' => 'En mission']);
        }
    }

    public static function finishMission(){
        $missions = Mission::all()->where('etat','=','Non fait');
        if( count( $missions ) > 0 ){
            foreach( $missions as $mission ){
                if( $mission->datefin < (date('Y-m-d')) ){
                    $m = Mission::find( $mission->id );
                    $m->etat = 'Fait';
                    $m->update();
                }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $voitures = $request['voiture'];
        foreach( $voitures as $voiture ){
            $mUser = MissionUser::find($voiture);
            $mUser->kmfin = $request[$voiture];
            $mUser->update();

            $kmdiff = (($mUser->kmfin) - ($mUser->kmdeb));
            $voit = Voiture::find($mUser->voiture_id);
            $voit->kmvidange += $kmdiff;
            $voit->kilmax -= $request[$voiture];
            $voit->update();
        }
        $this->rendreVoiture($id);

        $parametre = ['status'=>true, 'msg'=>'Mission modifiée avec succès'];
        return redirect()->route('missions')->with($parametre);
    }

    public function rendreVoiture($demande_id)
    {
        $status = true;
        $isAddKmDeb = DemandeController::kmDebutAjouterMission($demande_id);
        $isAddKmFin = DemandeController::kmFinAjouterMission($demande_id);

        if( ($isAddKmDeb == true) && ($isAddKmFin==true) ){
            $missions = Mission::all()->where('demande_id', '=', $demande_id);
            foreach( $missions as $mission ){
                if( $mission->type == 'voiture' ){
                    $voiture = Voiture::find($mission->affecter_id);
                    $voiture->dispo = "Disponible";
                    $voiture->mouvement = "Au parc";
                    $voiture->update();
                }
                if( $mission->type == 'chauffeur' ){
                    $user = User::find($mission->affecter_id);
                    $chauffeur = Chauffeur::find($user->chauffeur->id);
                    $chauffeur->disp = "Disponible";
                    $chauffeur->update();
                }
                $m = Mission::find($mission->id);
                $m->status = true;
                $m->update();
            }

            $demande = Demande::find($demande_id);
            $demande->status = "Rendu";
            $demande->etat = true;
            $status = $demande->update();
        }else{
            $status = false;
        }
        return $status;
    }

    public function addKm(Request $request, $id, $type)
    {
        if( $type == 'deb' ){
            $voitures = $request['voiture'];
            $status = true;
            foreach ($voitures as $voiture) {
                $mUser = Mission::find($voiture);
                $mUser->kmdeb = $request[$voiture];
                $status = $mUser->update();

                if (!$status) {
                    $parametre = ['status' => true, 'msg' => 'Erreur lors de la soumission'];
                    return redirect()->route('showDetail', ['id' => $id])->with($parametre);
                }
            }
            $out = $this->rendreVoiture($id);
            if( $out )
                $parametre = ['status' => true, 'msg' => 'Kilométrage ajouté et ressource rendu avec succès'];
            else
                $parametre = ['status' => true, 'msg' => 'Kilométrage ajouté avec succès'];
            return redirect()->route('showDetail', ['id' => $id])->with($parametre);
        }elseif($type == 'fin'){
            $voitures = $request['voiture'];
            foreach( $voitures as $voiture ){
                $mUser = Mission::find($voiture);
                $mUser->kmfin = $request[$voiture];
                $mUser->update();

                $kmdiff = (($mUser->kmfin) - ($mUser->kmdeb));
                $voit = Voiture::find($mUser->affecter_id);
                $voit->kmvidange += $kmdiff;
                $voit->kilmax -= $request[$voiture];
                $voit->update();
            }
            $out = $this->rendreVoiture($id);
            if( $out )
                $parametre = ['status' => true, 'msg' => 'Kilométrage ajouté et ressource rendu avec succès'];
            else
                $parametre = ['status' => true, 'msg' => 'Kilométrage ajouté avec succès mais ressource non rendu. Ajouter les Kilométrage'];
            return redirect()->route('showDetail', ['id' => $id])->with($parametre);
        }
        else{
            $parametre = ['status' => true, 'msg' => 'Erreur lors de la soumission'];
            return redirect()->route('showDetail', ['id' => $id])->with($parametre);
        }

        $parametre = ['status' => true, 'msg' => 'Kilométrage ajouté avec succès'];
        return redirect()->route('showDetail', ['id' => $id])->with($parametre);
    }

    public static function getVoiture($id){
        $voiture = Voiture::find($id);
        return $voiture;
    }

    public static function getVoitureInDemande($demande_id){
        $missions = Mission::all()
            ->where('demande_id', '=', $demande_id)
            ->where('type', '=', 'voiture');
        return $missions;
    }

    public static function missionModal($id, $url, $type=null, $userStructureId=null){
        $missions = self::getVoitureInDemande($id);
        if( $type == 'kmdeb' ) $msg = "Ajouter le kélométrage de début";
        if( $type == null ){
            $msg = "Complété le kilométrage de fin";
            $type = 'kmfin';
        }
        ?>
            <div class="modal fade" id="<?= $type ?>modal<?= $id ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><?= $msg ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= $url ?>" method="post">
                            <div class="row g-3">
                            <input type="hidden" name="_token" value="<?= csrf_token() ?>" />
                            <?=  method_field('PUT'); ?>
                            <?php
                            foreach ($missions as $mission) {
                                if( $type == 'kmdeb' ){
                                    ?>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="<?= self::getVoiture($mission->affecter_id)->marque . ' ('. self::getVoiture($mission->affecter_id)->immatriculation . ')'; ?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="<?= $mission->id ?>" value="<?php if( $mission->kmdeb != 0 ) echo $mission->kmdeb; ?>" class="form-control" min="1" placeholder="Kilométrage de début" required>
                                    </div>
                                    <input type="hidden" name="voiture[]" value="<?= $mission->id ?>">
                                    <?php
                                }
                                if( $type == 'kmfin' ){
                                    ?>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="<?= self::getVoiture($mission->affecter_id)->marque . ' ('. self::getVoiture($mission->affecter_id)->immatriculation . ')'; ?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="<?= $mission->id ?>" value="<?php if( $mission->kmfin != 0 ) echo $mission->kmfin; ?>" class="form-control" min="1" placeholder="Kilométrage de fin" required>
                                    </div>
                                    <input type="hidden" name="voiture[]" value="<?= $mission->id ?>">
                                    <?php
                                }
                            }
                            ?>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
        <?php
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mission = Mission::find($id);
        if($mission != null){
            $status = $mission->delete();
            if( $status ) $parametre = ['status'=>true, 'msg'=>'Mission supprimée avec succès'];
            else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
            return redirect()->route('missions')->with($parametre);
        }else{
            return view('missions.all', compact('mission'));
        }
    }

    public static function select_option( $array, $default=null ){
        $option = '';
            foreach ($array as $key => $value) {
                if( ( $default != null ) && ( $default == $value )){
                        $option .= "<option selected='selected' value='". $value ."'>". $key . "</option>";
                }else{
                    $option .= "<option value='". $value ."'>". $key . "</option>";
                }
            }
        return $option;
    }

    public static function getStructureChauffeure($id){
        $datas = Chauffeur::all()->where('disp','=','Disponible');
        $chauffeurUser = array();
        foreach($datas as $data){
            $chauffeurUser = array_merge($chauffeurUser, array($data['user_id']));
        }

        $chauffeures = User::where('structure_id','=',$id)
            ->whereIn('id',$chauffeurUser)
            ->get()->pluck('id','name')->toArray();
        return $chauffeures;
    }
}
