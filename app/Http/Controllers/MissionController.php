<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\MissionUser;
use App\Models\Mission;
use App\Models\User;
use App\Models\Voiture;
use Illuminate\Support\Facades\Auth;
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

            // $vDispo = Voiture::find($voiture);
            // $vDispo->dispo = "Disponible";
            // $vDispo->update();
        }
        $mission = Mission::find($id);
        $mission->etat = "Fait";
        $mission->update();

        $mission = Mission::all();
        return view('missions.all', compact('mission'));
    }

    public static function missionModal($id, $url){
        $voituremissions = DB::table('mission_users')
            ->join('voitures', 'voitures.id', '=', 'mission_users.voiture_id')
            ->select('voitures.*')
            ->where('mission_users.mission_id', '=', $id)
            ->get();
        ?>
            <div class="modal fade" id="modal<?= $id ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Complété le kilométrage de fin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 col-md-8 d-flex flex-column align-items-center justify-content-center">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <form class="row g-3 needs-validation" action="<?= $url ?>" method="post">
                                            <input type="hidden" name="_token" value="<?= csrf_token() ?>" />
                                            <?=  method_field('PUT'); ?>
                                                <?php
                                                    foreach ($voituremissions as $key) {
                                                        ?>
                                                            <input type="text" class="form-control" value="<?= $key->marque . ' ('. $key->immatriculation . ')'; ?>" disabled>
                                                            <input type="hidden" name="voiture[]" value="<?= $key->id ?>">
                                                            <input type="number" name="<?= $key->id ?>" class="form-control" min="1" placeholder="Kilométrage de fin" required>
                                                        <?php
                                                    }
                                                ?>
                                                <div class="col-12">
                                                    <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
}
