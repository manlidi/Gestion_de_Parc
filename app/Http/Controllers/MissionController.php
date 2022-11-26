<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mission;
use App\Models\Voiture;
use App\Models\Chauffeur;
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
        MissionUserController::rendreVoiture($id);
        // $mission = Mission::find($id);
        // $status = $mission->update();

        $parametre = ['status'=>true, 'msg'=>'Mission modifiée avec succès'];
        return redirect()->route('missions')->with($parametre);
    }

    public static function missionModal($id, $url, $type=null, $userStructureId=null){
        $voituremissions = Mission::find($id)->mission_users;
        if( $type == 'chauffeure' ) $msg = "Ajouter les chauffeurs au mission";
        if( $type == 'kmdeb' ) $msg = "Ajouter le kélométrage de début";
        if( $type == null ) $msg = "Complété le kilométrage de fin";
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
                            foreach ($voituremissions as $key) {
                                if( $type == 'chauffeure' ){
                                    ?>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="<?= $key->voiture->marque . ' ('. $key->voiture->immatriculation . ')'; ?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <select id="inputState" name="<?= $key->id ?>" class="form-select">
                                            <option value="">Choisir Chauffeur ...</option>
                                            <?php
                                                if( $key->chauffeur != null ){
                                                    echo self::select_option(self::getStructureChauffeure( $userStructureId ), $key->chauffeur->id);
                                                }else{
                                                    echo self::select_option(self::getStructureChauffeure( $userStructureId ));
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="chauffeur[]" value="<?= $key->id ?>">
                                    <?php
                                }
                                if( $type == 'kmdeb' ){
                                    ?>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="<?= $key->voiture->marque . ' ('. $key->voiture->immatriculation . ')'; ?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="<?= $key->id ?>" value="<?php if( $key->kmdeb != 0 ) echo $key->kmdeb; ?>" class="form-control" min="1" placeholder="Kilométrage de début" required>
                                    </div>
                                    <input type="hidden" name="voiture[]" value="<?= $key->id ?>">
                                    <?php
                                }
                                if( $type == null ){
                                    ?>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="<?= $key->voiture->marque . ' ('. $key->voiture->immatriculation . ')'; ?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="<?= $key->id ?>" class="form-control" min="1" placeholder="Kilométrage de fin" required>
                                    </div>
                                    <input type="hidden" name="voiture[]" value="<?= $key->id ?>">
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
