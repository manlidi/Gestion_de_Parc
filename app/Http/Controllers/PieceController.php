<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Piece;
use App\Models\Voiture;

class PieceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $piece = Piece::all();
        return view('pieces.all', compact('piece'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $voiture = Voiture::all()->where('structure_id', '=', Auth::user()->structure_id);
        return view('pieces.add', compact('voiture'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $piece = new Piece();
        $piece->nompiece = $request->nompiece;
        $piece->datefin = $request->datefin;
        $piece->voiture_id = $request->voiture_id;
        $status = $piece->save();

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Pièce Enrégistré avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('pieces')->with($parametre);
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
