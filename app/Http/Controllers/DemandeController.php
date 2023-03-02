<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Piece;
use App\Models\Garage;
use App\Models\Demande;
use App\Models\Mission;
use App\Models\Reparer;
use App\Models\Voiture;
use App\Mail\RejeterMail;
use App\Mail\ValiderMail;
use App\Models\Chauffeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $demande = Demande::all()->where('user_id', Auth::user()->id)->where('status', 'Non Approuvée');
        return view('demandes.all', compact('demande'));
    }

    public function indexAdminApprouve(){
        $demandes = Demande::all()->where('status', 'Approuvée');
        return view('demandes.adminDemandeApprouve', compact('demandes'));
    }

    public function indexApprouve(){
        $demandes = DB::table('demandes')
            ->join('users', 'users.id', '=', 'demandes.user_id')
            ->select('demandes.*')
            ->where('demandes.user_id', '=', Auth::user()->id)
            ->where('status', '=', 'Approuvée')
            ->get();

        $nonValidedemandes = DB::table('demandes')
            ->join('users', 'users.id', '=', 'demandes.user_id')
            ->select('demandes.*')
            ->where('demandes.user_id', '=', Auth::user()->id)
            ->where('status', '=', 'Non Approuvée')
            ->get();
        return view('demandes.mesDemande', compact('demandes', 'nonValidedemandes'));
    }

    public function indexAdmin(){
        $demande = DB::table('demandes')
            ->join('users', 'users.id', '=', 'demandes.user_id')
            ->select('demandes.*', 'users.structure_id')
            ->where('users.structure_id', '=', User::find(Auth::user()->id)->structure_id)
            ->where('status', '=', 'Non Approuvée')
            ->get();

        return view('demandes.admindemandes', compact('demande'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createVoiture()
    {
        //$authorId = Auth::user()->id;
        //$id = User::find($authorId)->structure->id;
        //dd($id);
        $voiture = Voiture::all()
            ->where('dispo', '=', 'Disponible');
            //->where('structure_id', '=', $id);

        $chauffeur = self::chauffeurDispo();
        return view('demandes.askVoiture', compact('voiture', 'chauffeur'));
    }

    public function modifierdemandevoiture($id){
        $demande = Demande::find($id);
        return view('demandes.askVoiture', compact('demande'));
    }

    public function addReparationDetail($id){
        $voiture = Voiture::find($id);
        $pieces = Piece::all();
        $garages = Garage::all();
        return view('demandes.addReparationDetail',compact('voiture','pieces', 'garages'));
    }

    public function createReparation()
    {
        $authorId = Auth::user()->id;
        $voitures = DB::table('voitures')
            ->join('missions','missions.affecter_id','=','voitures.id')
            ->join('demandes','demandes.id','=','missions.demande_id')
            ->select('missions.*','voitures.*', 'demandes.*')
            ->where('demandes.user_id', '=', $authorId)
            ->where('mouvement','=','En mission')
            ->where('missions.type','=','voiture')
            ->where('missions.status','=',0)
            ->get();

        return view('demandes.addReparation', compact('voitures'));
    }

    public static function chauffeurDispo(){
        $datas = Chauffeur::all()->where('disp','=','Disponible');
        $chauffeurUser = array();
        foreach($datas as $data){
            $chauffeurUser = array_merge($chauffeurUser, array($data['user_id']));
        }
        $chauffeur = User::all()->whereIn('id',$chauffeurUser);
        return $chauffeur;
    }

    public function createChauffeur()
    {
        $authorId = Auth::id();
        $id = User::find($authorId)->structure->id;
        $chauffeur = self::chauffeurDispo();
        return view('demandes.addChauffeur', compact('chauffeur'));
    }

    public function store(Request $request, $type)
    {
        $request->validate([
            'objetdemande' => 'required',
            'description' => 'required',
            'nbreVoiture' => 'required',
            'nbPlace' => 'required',
            'datedeb' => 'required',
            'datefin'    =>  'required|date|after:datedeb'
        ]);

        if( $request->addchauffeur != null ) $addchauf = true;
        else $addchauf = false;

        $status = Demande::create([
            'objetdemande' => $request->objetdemande,
            'description' => $request->description,
            'addchauffeur' => $addchauf,
            'datedeb' => $request->datedeb,
            'nbreVoiture' => $request->nbreVoiture,
            'nbPlace' => $request->nbPlace,
            'datefin' => $request->datefin,
            'user_id' => Auth::user()->id,
            'type' => $type
        ]);

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Votre demande a été enregistré avec succès. Veuillez attendre sa validation!'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
            return redirect()->route('mesDemabdes')->with($parametre);
    }

    public function saveDemandeReparation( Request $request, $id ){
        $voiture = Voiture::find($id);
        $demande = Demande::create([
            'objetdemande' => "Réparation (". $voiture->marque ."/". $voiture->immatriculation .")",
            'affecter_id' => $id,
            'description' => 'Demande de Réparation',
            'type' => 'reparation',
            'user_id' => Auth::user()->id
        ]);

        $data = [
            'panne' => $request['panne'],
            'garage_id' => $request['garage'],
            'voiture_id' => $id,
            'user_id' => Auth::user()->id,
            'demande_id' => $demande->id
        ];

        if( isset( $request['pieces'] ) ){
            $data += ['pieces' => serialize( $request['pieces'] )];
        }

        $status = Reparer::create($data);

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Votre demande de réparation a été envoyer avec succès. Veuillez attendre sa validation !'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de la demande'];
        return redirect()->route('dashboard')->with($parametre);
    }

    public static function isdemanderEnReparation($id){
        $status = false;
        $demandes = Demande::all()
            ->where('user_id','=',Auth::user()->id)
            ->where('type','=','reparation')
            ->where('status','=','Approuvée');
        foreach($demandes as $demande){
            if( $demande->affecter_id == $id ){
                return true;
            }
        }
        return $status;
    }

    public function updateDemandeVoiture( $id ){
        $demande = Demande::find($id);
        $voiture = Voiture::all()
            ->where('dispo', '=', 'Disponible')
            ->where('structure_id', '=', $id);
        return view('demandes.addVoiture', compact('voiture','demande'));
    }
    public function updateDemandeChauffeur( $id ){
        $demande = Demande::find($id);
        $chauffeur = Chauffeur::all()
            ->where('disp', '=', 'Disponible')
            ->where('structure_id', '=', $id);
        return view('demandes.addChauffeur', compact('chauffeur','demande'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $type)
    {

        if( $request->addchauffeur != null ) $addchauf = true;
        else $addchauf = false;
        //dd($request);
        $demande = Demande::find($id);
        $demande->objetdemande = $request->objetdemande;
        $demande->description = $request->description;
        $demande->nbreVoiture = $request->nbreVoiture;
        $demande->nbPlace = $request->nbPlace;
        $demande->addchauffeur = $addchauf;
        $demande->datedeb = $request->datedeb;
        $demande->datefin = $request->datefin;
        $demande->type = $type;
        $demande->user_id = Auth::user()->id;
        $status = $demande->update();

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Votre modification a été enregistré avec succès. Veuillez attendre sa validation!'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de la modification'];
        return redirect()->route('mesDemabdes')->with($parametre);
    }

    public static function modal($id, $url, $type=null){
        $chauffeurs = self::chauffeurDispo();
        $voitures = Voiture::all()->where('dispo','=','Disponible');
        ?>
        <div class="modal fade" id="validerdemande<?= $id ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Veuillez affecter les voitures/chauffeures</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= $url ?>" method="post">
                        <div class="row g-3">
                            <input type="hidden" name="_token" value="<?= csrf_token() ?>" />
                            <?=  method_field('PUT'); ?>
                            <div class="col-sm-12">
                                <label for="">Veuillez choisir les voitures</label>
                                <select class="form-control selectpicker" multiple data-live-search="true" name="voitures[]" id="voitures">
                                    <?php
                                    if($voitures->count() > 0){
                                        foreach ($voitures as $us){
                                            ?>
                                                <option value="<?= $us->id ?>"><?= $us->marque ?></option>
                                           <?php
                                        }
                                    }else{
                                        ?>
                                            <option value="">Pas de voiture disponible</option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label for="">Veuillez choisir les chauffeures</label>
                                <select class="form-control selectpicker" multiple data-live-search="true" name="chauffeures[]" id="chauffeures">
                                    <?php
                                    if($chauffeurs->count() > 0){
                                        foreach ($chauffeurs as $us){
                                            ?>
                                                <option value="<?= $us->id ?>"><?= $us->name ?></option>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                            <option value="">Pas de chauffeur disponible</option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
    <?php
    }

    public function showDetailDemande( $id ){
        $demande = Demande::find($id);
        $kmDebutAjouterMission = self::kmDebutAjouterMission($id);
        $kmFinAjouterMission = self::kmFinAjouterMission($id);

        $voitures = DB::table('missions')
            ->join('voitures','voitures.id','=','missions.affecter_id')
            ->select('missions.*','voitures.*')
            ->where('demande_id', '=', $id)
            ->where('type','=','voiture')
            ->get();

        if($demande->addchauffeur){
            $chauffeurs = DB::table('missions')
                ->join('users','users.id','=','missions.affecter_id')
                ->join('chauffeurs','chauffeurs.user_id','=','users.id')
                ->select('missions.*','users.*', 'chauffeurs.*')
                ->where('demande_id', '=', $id)
                ->where('type','=','chauffeur')
                ->get();
            return view('demandes.showDemande', compact('demande', 'voitures', 'chauffeurs', 'kmDebutAjouterMission', 'kmFinAjouterMission'));
        }
        return view('demandes.showDemande', compact('demande', 'voitures', 'kmDebutAjouterMission', 'kmFinAjouterMission'));
    }

    public function formValide($id){
        $demande = Demande::find($id);
        $kmDebutAjouterMission = self::kmDebutAjouterMission($id);

        $voitures = Voiture::all()
            ->where('dispo', '=', 'Disponible')
            ->where('structure_id','=',User::find(Auth::user()->id)->structure_id);

        $chauffeurs = Chauffeur::all()
            ->where('disp', '=', 'Disponible');

        return view('demandes.formValideDemande', compact('demande', 'voitures', 'chauffeurs', 'kmDebutAjouterMission'));
    }

    public function sendMailUserDemande($senderEmail, $name){
        $contenu = [
            'titre' => 'Demande de Voiture (MP)',
            'nom' => $name
        ];

        return Mail::to($senderEmail)->send(new ValiderMail($contenu));
    }
    public function sendMailUserDemandeRejeter($senderEmail, $name, $demandeobjet, $demandetype){
        $contenu = [
            'titre' => 'Demande de Voiture (MP)',
            'nom' => $name,
            'demande' => $demandeobjet,
            'demandetype' => $demandetype
        ];

        return Mail::to($senderEmail)->send(new RejeterMail($contenu));
    }

    public function addkmdeb(Request $request, $id){
        if(count($request->all()) > 0){
            foreach($request->all() as $voiture_id => $km){
                if(is_int($voiture_id)){
                    $mission = Mission::where('affecter_id', '=', $voiture_id)
                        ->where('type', '=', 'voiture')
                        ->where('demande_id', '=', $id)
                        ->first();
                    $mission->kmdeb = $km;
                    $mission->update();
                }
            }
        }
        return redirect()->route('admin_demandes')->with(['status' => true, 'msg' => 'Demande validée avec succès !']);
    }

    public function validerDemande(Request $request, $id, $type){
        if( $type == 'voiture' ){
            $request->validate([
                'voitures' => 'required',
            ]);

            $demande = Demande::find($id);
            $user = User::find($demande->user_id);
            $send = $this->sendMailUserDemande($user->email, $user->name);
            $voitureValides = [];

            if( $send ){
                $nbre = count( $request->voitures );
                if( $nbre > $demande->nbreVoiture ){
                    return redirect()->route('formValide', ['id' => $id])->with(['status'=>true, 'msg'=> 'Vous avez ajouté plus de voiture que demandée']);
                }else{
                    foreach( $request->voitures as $caisse ){
                        $voiture = Voiture::find($caisse);
                        $voiture->dispo = 'Non Disponible';
                        $voiture->mouvement = 'En mission';
                        $voiture->update();

                        $voitureValides[] = Mission::create([
                            'demande_id' => $demande->id,
                            'affecter_id' => $voiture->id,
                            'type' => 'voiture'
                        ]);
                    }

                    if( isset( $request->chauffeurs ) ){
                        foreach( $request->chauffeurs as $chauf ){
                            $user = User::find($chauf);
                            $chauffeur = Chauffeur::find($user->chauffeur->id);
                            $chauffeur->disp = 'Non Disponible';
                            $chauffeur->update();

                            Mission::create([
                                'demande_id' => $demande->id,
                                'affecter_id' => $user->id,
                                'type' => 'chauffeur'
                            ]);
                        }
                    }
                    $demande->status = 'Approuvée';
                    $demande->update();
                    return view('demandes.formAddKm', compact('demande', 'voitureValides'));
                }
            }else{
                return redirect()->route('admin_demandes')->with(['status' => true, 'msg' => 'Une erreur est survenu lors de la validation de la demande !']);
            }
        }
        if($type == 'reparation'){
            $caisse = Reparer::all()->where('demande_id', '=', $id)->first();
            $demande = Demande::find($id);

            $voiture = Voiture::find($caisse->voiture_id);
            $voiture->dispo = 'Non Disponible';
            $voiture->mouvement = 'En reparation';
            $voiture->update();

            $demande->status = 'Approuvée';
            $demande->update();
            return redirect()->route('admin_demandes')->with(['status' => true, 'msg' => 'Demande validée avec succès']);
        }
    }

    public static function isDemandeRespo( $demande_id ){
        $demande = Demande::find($demande_id);
        $user_strucutre = User::find($demande->user_id)->structure_id;
        if( (Auth::user()->role == 'Administrateur') && ($user_strucutre == Auth::user()->structure_id) ){
            return true;
        }
        return false;
    }

    public static function kmDebutAjouterMission($demande_id)
    {
        $ajouter = true;
        $missions = Mission::all()
            ->where('demande_id','=',$demande_id)
            ->where('type','=','voiture');

        foreach ($missions as $mission) {
            if ($mission->kmdeb == 0) {
                $ajouter = false;
            }
            $voiture = Voiture::find($mission->affecter_id);
            if( $voiture->mouvement == 'En reparation' ){
                return true;
            }
        }
        return $ajouter;
    }

    public static function kmFinAjouterMission($demande_id)
    {
        $ajouter = true;
        $missions = Mission::all()
            ->where('demande_id','=',$demande_id)
            ->where('type','=','voiture');

        foreach ($missions as $mission) {
            if ($mission->kmfin == 0) {
                $ajouter =  false;
            }
            $voiture = Voiture::find($mission->affecter_id);
            if( $voiture->mouvement == 'En reparation' ){
                return true;
            }
        }
        return $ajouter;
    }

    public function desapprouverDemande( $id, $type ){
        $demande = Demande::find($id);
        $demande->status = "Non Approuvée";
        $status = $demande->update();

        if( $type == 'voiture' ){
            $missions = Mission::all()->where('demande_id', '=', $id);
            if( count($missions) > 0 ){
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
                    $m->delete();
                }
            }else{
                $status = false;
            }
        }

        if( $type == 'reparation' ){
            $caisse = Reparer::all()->where('demande_id', '=', $id)->first();

            $voiture = Voiture::find($caisse->voiture_id);
            $voiture->dispo = 'Non Disponible';
            $voiture->mouvement = 'En mission';
            $voiture->update();

            $reparer = Reparer::find($caisse->id);
        }

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Demande désapprouvée avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de la soumission'];
        return redirect()->route('adminDemandeApprouve')->with($parametre);
    }

    public function rejeterDemande($id, $type){
        $demande = Demande::find($id);
        $user = User::find($demande->user_id);
        $send = $this->sendMailUserDemandeRejeter($user->email, $user->name, $demande->objetdemande, $demande->type);

        if( $send ){
            $status = $demande->delete();

            if( $status ) $parametre = ['status'=>true, 'msg'=>'Demande rejetée avec succès'];
            return redirect()->route('admin_demandes')->with($parametre);
        }else{
            $parametre = ['status'=>true, 'msg'=>'Une erreur est survenue lors du rejet de la demande'];
            return redirect()->route('admin_demandes')->with($parametre);
        }
    }

    public static function voitureIsDispo( $id ){
        $voiture = Voiture::find($id);
        if( $voiture->dispo == "Disponible" ) return true;
        else return false;
    }

    public function rendreDemande( $id, $type ){
        if( $type == 'reparation' ){
            $demande = Demande::find($id);
            $demande->status = "Rendu";
            $demande->update();

            $caisse = Reparer::all()->where('demande_id', '=', $id)->first();

            $voiture = Voiture::find($caisse->voiture_id);
            $voiture->dispo = 'Non Disponible';
            $voiture->mouvement = 'En mission';
            $voiture->update();

            $reparer = Reparer::find($caisse->id);
        }
        $parametre = ['status'=>false, 'msg'=>'Reparation terminée avec succès'];
        return redirect()->route('dashboard')->with($parametre);
    }

    public static function chauffeurIsDispo( $id ){
        $chauffeurs = DB::table('users')
        ->join('chauffeurs', 'users.id', '=', 'chauffeurs.user_id')
        ->select('chauffeurs.*')
        ->where('chauffeurs.user_id', '=', $id)
        ->get();

        foreach($chauffeurs as $chauffeur){
            //dd($chauffeur->disp);
            if( $chauffeur->disp == "Disponible" ) return true;
            else return false;
        }
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
