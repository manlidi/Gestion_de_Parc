<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Demande;
use Illuminate\Support\Facades\DB;
use App\Models\Voiture;
use App\Models\Chauffeur;
use App\Models\Garage;
use App\Models\Piece;
use App\Models\Reparer;
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
        $demande = Demande::all()->where('user_id', Auth::user()->id)->where('status', 'Non Approuvée');
        return view('demandes.all', compact('demande'));
    }

    public function indexAdminApprouve(){
        $demande = Demande::all()->where('status', 'Approuvée');
        return view('demandes.adminDemandeApprouve', compact('demande'));
    }

    public function indexApprouve(){
        $demande = DB::table('demandes')
            ->join('users', 'users.id', '=', 'demandes.user_id')
            ->select('demandes.*')
            ->where('demandes.user_id', '=', Auth::user()->id)
            ->where('status', '=', 'Approuvée')
            ->get();
        return view('demandes.demandeApprouve', compact('demande'));
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
        $authorId = Auth::id();
        $id = User::find($authorId)->structure->id;
        $voiture = Voiture::all()
            ->where('dispo', '=', 'Disponible')
            ->where('structure_id', '=', $id);

        $chauffeur = self::chauffeurDispo();
        return view('demandes.addVoiture', compact('voiture', 'chauffeur'));
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
        $voiture = DB::table('mission_users')
            ->join('voitures','voitures.id','=','mission_users.voiture_id')
            ->select('mission_users.*','voitures.*')
            ->where('user_id', '=', $authorId)
            ->where('mouvement','=','En mission')
            ->get();
        $voituredemande = DB::table('demandes')
            ->join('voitures', 'voitures.id', '=', 'demandes.affecter_id')
            ->select('voitures.*')
            ->where('demandes.type', '=', 'voiture')
            ->where('demandes.user_id', '=', $authorId)
            ->where('demandes.status', '=', 'Approuvée')
            ->get();
        return view('demandes.addReparation', compact('voiture', 'voituredemande'));
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

    public function saveDemandeReparation( Request $request, $id ){
        $voiture = Voiture::find($id);
        $demande = Demande::create([
            'objetdemande' => "Réparation (". $voiture->marque ."/". $voiture->immatriculation .")",
            'affecter_id' => $id,
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
        $demandes = Demande::all()->where('user_id','=',Auth::user()->id)->where('type','=','reparation');
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
        $demande = Demande::find($id);
        $demande->objetdemande = $request->objetdemande;
        $demande->datedeb = $request->datedeb;
        $demande->datefin = $request->datefin;
        if( $type == 'voiture' ){
            $demande->affecter_id = $request->voiture_id;
        }else{
            $demande->affecter_id = $request->chauffeur_id;
        }
        $demande->type = $type;
        $demande->user_id = Auth::user()->id;
        $status = $demande->update();

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Votre modification a été enregistré avec succès. Veuillez attendre sa validation!'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de la modification'];
        return redirect()->route('dashboard')->with($parametre);
    }

    public function validerDemande($id, $type){
        $demande = Demande::find($id);
        $demande->status = "Approuvée";
        $status = $demande->update();

        if( $type == 'voiture' ){
            $voiture = Voiture::find($demande->affecter_id);
            $voiture->dispo = "Non Disponible";
            $voiture->mouvement = "En sortie";
            $voiture->update();
        }

        if( $type == 'chauffeur' ){
            $chauffeurs = Chauffeur::all()->where('user_id', '=', $demande->affecter_id);
            foreach($chauffeurs as $chauffeur){
                //dd($chauffeur->disp);
                $chauffeur->disp = "Non Disponible";
                $chauffeur->update();
            }
        }

        if( $type == 'reparation' ){
            $voiture = Voiture::find($demande->affecter_id);
            $voiture->dispo = "Non Disponible";
            $voiture->mouvement = "Au garage";
            $voiture->update();
        }

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Demande approuvée avec succès !'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de la validation de la demande'];
        return redirect()->route('admin_demandes')->with($parametre);
    }

    public function rendreDemande( $id, $type ){
        $demande = Demande::find($id);
        $demande->status = "Rendu";
        $status = $demande->update();

        if( $type == 'voiture' ){
            $voiture = Voiture::find($demande->affecter_id);
            $voiture->dispo = "Disponible";
            $voiture->mouvement = "Au parc";
            $voiture->update();
        }

        if( $type == 'chauffeur' ){
            $chauffeur = Chauffeur::find($demande->affecter_id);
            $chauffeur->disp = "Disponible";
            $chauffeur->update();
        }

        if( $type == 'reparation' ){
            $voiture = Voiture::find($demande->affecter_id);
            $voiture->dispo = "Disponible";
            $voiture->mouvement = "Au parc";
            $voiture->update();

            $reparation = Reparer::where('demande_id','=',$id)->first();
            $reparation->datereparation = now();
            $reparation->update();
        }

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Voiture ou Chauffeur rendu avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de la soumission'];
        return redirect()->route('listereparation')->with($parametre);
    }

    public function desapprouverDemande( $id, $type ){
        $demande = Demande::find($id);
        $demande->status = "Non Approuvée";
        $status = $demande->update();

        if( $type == 'voiture' ){
            $voiture = Voiture::find($demande->affecter_id);
            $voiture->dispo = "Disponible";
            $voiture->mouvement = "En sortie";
            $voiture->update();
        }

        if( $type == 'chauffeur' ){
            $chauffeur = Chauffeur::find($demande->affecter_id);
            $chauffeur->disp = "Disponible";
            $chauffeur->update();
        }

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Demande désapprouvée avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de la soumission'];
        return redirect()->route('adminDemandeApprouve')->with($parametre);
    }

    public function rejeterDemande($id, $type){
        $demande = Demande::find($id);
        $status = $demande->delete();

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Demande rejetée avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de la soumission'];
        return redirect()->route('admin_demandes')->with($parametre);
    }

    public static function voitureIsDispo( $id ){
        $voiture = Voiture::find($id);
        if( $voiture->dispo == "Disponible" ) return true;
        else return false;
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
