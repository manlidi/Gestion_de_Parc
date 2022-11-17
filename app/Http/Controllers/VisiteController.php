<?php

namespace App\Http\Controllers;

use App\Models\Visite;
use App\Models\Voiture;
use Illuminate\Http\Request;

class VisiteController extends Controller
{

    public function actionVoiture(Request $request)
    {
        if( $request['voitures'] != null ){
            if ($request['actionVoiture'] == 'visiteTechnique') {
                $date = now();
                foreach ($request['voitures'] as $voiture) {
                    $visite = Visite::create([
                        'datevisite' => $date,
                        'voiture_id' => $voiture
                    ]);
    
                    $voit = Voiture::find($voiture);
                    $voit->dispo = "Non disponible";
                    $voit->mouvement = "En visite technique";
                    $voit->date_next_visite = $date;
                    $voit->status_visite = true;
                    $voit->update();
                }
                return self::returnUrl();
            }
            if ($request['actionVoiture'] == 'vidange') {
                foreach ($request['voitures'] as $voiture) {
                    $voit = Voiture::find($voiture);
                    $visite = Visite::create([
                        'kmvidange' => $voit->kmvidange,
                        'voiture_id' => $voiture
                    ]);
    
                    $voit->dispo = "Non disponible";
                    $voit->mouvement = "En vidange";
                    $voit->status_vidange = true;
                    $voit->update();
                }
                return self::returnUrl();
            }
            
        }else{
            if ($request['actionVoiture'] == 'visiteTechniqueAllTermine') {
                $voitures = Voiture::all()->where('mouvement', '=', 'En visite technique');
                
                if( count($voitures) > 0 ){
                    $type = 'all';
                    return view('visite.valideVisite', compact('voitures', 'type'));
                }else{
                    $parametre = ['status' => true, 'msg' => 'Pas de voiture en visite technique', 'class'=>'danger'];
                    return redirect()->route('voitures')->with($parametre);
                }
            }
    
            if ($request['actionVoiture'] == 'vidangeAllTermine') {
                $voitures = Voiture::all()->where('mouvement', '=', 'En vidange');
                foreach( $voitures as $voiture ){
                    $this->terminerVidange($voiture->id, true);
                }
                return self::returnUrl();
            }
            $parametre = ['status' => true, 'msg' => 'Erreur! Vous devez sélectionner la voiture et l\'action.', 'class'=>'danger'];
            return redirect()->route('voitures')->with($parametre);
        }
    }

    public function terminerVidange( $id, $all=false ){
        $v = Voiture::find($id);
        $v->status_vidange = false;
        $v->kmvidange = 0;
        $v->dispo = "Disponible";
        $v->mouvement = "Au parc";
        $v->update();

        if( ! $all )
            return self::returnUrl();
    }

    public function terminerViste($id)
    {
        $voiture = Voiture::find($id);
        $type = 'one';
        return view('visite.valideVisite', compact('voiture', 'type'));
    }

    public static function returnUrl()
    {
        $parametre = ['status' => true, 'msg' => 'Opération effectué avec succès', 'class'=>'success'];
        return redirect()->route('voitures')->with($parametre);
    }

    public function terminerVisteStore(Request $request, $id = null)
    {
        if ($id != null) {
            self::modelSaveVisite($id, $request[$id]);
        } else {
            foreach( $request['voitures'] as $id ){
                self::modelSaveVisite($id, $request[$id]);
            }
        }
        $parametre = ['status' => true, 'msg' => 'Visite technique terminée avec succès', 'class'=>'success'];
        return redirect()->route('voitures')->with($parametre);
    }

    public static function modelSaveVisite($id, $date)
    {
        $voiture = Voiture::find($id);
        $visite = Visite::where('voiture_id', '=', $id)
            ->where('datevisite', '=', $voiture->date_next_visite)
            ->first();
        $visite->status = true;
        $visite->update();

        $voiture->dispo = "Disponible";
        $voiture->mouvement = "Au parc";
        $voiture->date_next_visite = $date;
        $voiture->status_visite = false;
        $voiture->update();
    }
}
