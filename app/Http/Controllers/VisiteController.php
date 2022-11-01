<?php

namespace App\Http\Controllers;

use App\Models\Visite;
use App\Models\Voiture;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVisiteRequest;
use App\Http\Requests\UpdateVisiteRequest;

class VisiteController extends Controller
{

    public function actionVoiture(Request $request)
    {
        if ($request['actionVoiture'] == 'visiteTechnique') {
            foreach ($request['voitures'] as $voiture) {
                $voit = Voiture::find($voiture);
                $visite = Visite::create([
                    'kmvidange' => $voit->kmvidange,
                    'voiture_id' => $voiture
                ]);

                $voit->dispo = "Non disponible";
                $voit->mouvement = "En visite technique";
                $voit->status_visite = true;
                $voit->update();
            }
            return self::returnUrl();
        }
        if ($request['actionVoiture'] == 'visiteTechniqueAllTermine') {
            $voitures = Voiture::all()->where('mouvement', '=', 'En visite technique');
            foreach( $voitures as $voiture ){
                $v = Voiture::find($voiture->id);
                $v->status_visite = false;
                $v->kmvidange = 0;
                $v->dispo = "Disponible";
                $v->mouvement = "Au parc";
                $v->update();
            }
            return self::returnUrl();
        }
    }

    public function terminerViste($id)
    {
        $voiture = Voiture::find($id);
        $voiture->status_visite = false;
        $voiture->kmvidange = 0;
        $voiture->dispo = "Disponible";
        $voiture->mouvement = "Au parc";
        $voiture->update();
        return self::returnUrl();
    }

    public static function returnUrl()
    {
        $parametre = ['status' => true, 'msg' => 'Voiture envoyée en visite technique avec succès'];
        return redirect()->route('voitures')->with($parametre);
    }
}
