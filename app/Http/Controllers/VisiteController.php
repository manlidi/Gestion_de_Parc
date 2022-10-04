<?php

namespace App\Http\Controllers;

use App\Models\Visite;
use App\Models\Voiture;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVisiteRequest;
use App\Http\Requests\UpdateVisiteRequest;

class VisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function actionVoiture(Request $request)
    {
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
        if ($request['actionVoiture'] == 'visiteTechniqueAllTermine') {
            $voitures = Voiture::all()->where('mouvement', '=', 'En visite technique');
            $type = 'all';
            return view('visite.valideVisite', compact('voitures', 'type'));
        }
    }

    public function terminerViste($id)
    {
        $voiture = Voiture::find($id);
        $type = 'one';
        return view('visite.valideVisite', compact('voiture', 'type'));
    }

    public static function returnUrl()
    {
        $parametre = ['status' => true, 'msg' => 'Voiture envoyée en visite technique avec succès'];
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
        $parametre = ['status' => true, 'msg' => 'Visite technique terminée avec succès'];
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVisiteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVisiteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visite  $visite
     * @return \Illuminate\Http\Response
     */
    public function show(Visite $visite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visite  $visite
     * @return \Illuminate\Http\Response
     */
    public function edit(Visite $visite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVisiteRequest  $request
     * @param  \App\Models\Visite  $visite
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVisiteRequest $request, Visite $visite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visite  $visite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visite $visite)
    {
        //
    }
}
