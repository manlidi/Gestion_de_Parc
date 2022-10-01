<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use Illuminate\Support\Facades\DB;
use App\Models\MissionUser;
use App\Models\Mission;
use App\Models\Voiture;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $voiture = Voiture::all()->where('dispo', '=', 'Disponible');
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
            'datefin'    =>  'required|date|after:datedeb'
        ]);

        $data = $request->all();
        $check = $this->show($data);

        $mission = Mission::all();
        return view('missions.all', compact('mission'));
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

            $voit = Voiture::find($mUser->voiture_id);
            $voit->kilmax -= $request[$voiture];
            $voit->update();
        } 
        $mission = Mission::find($id);
        $mission->etat = "Fait";
        $mission->update();

        $chauffeur = DB::table('mission_users')
            ->join('chauffeurs', 'chauffeurs.id', '=', 'mission_users.chauffeur_id')
            ->join('missions', 'missions.id', '=', 'mission_users.mission_id')
            ->select('chauffeurs.*')
            ->where('missions.id', $id)
            ->get();
        dd($chauffeur);

        $mission = Mission::all();
        return view('missions.all', compact('mission'));
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
            $mission->delete();
            $mission = Mission::all();
            return view('missions.all', compact('mission'));
        }else{
            echo 'erreur';
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
        $chauffeures = Chauffeur::where('structure_id','=',$id,'AND','disp','=','Disponible')->get()->pluck('id','nom_cva')->toArray();
        return $chauffeures;
    }
}
