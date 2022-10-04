<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assurance;
use App\Models\Voiture;
use Illuminate\Support\Facades\DB;
use Session;

class AssuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assurance = Assurance::all()->where('status','=',true);
        return view('assurances.all', compact('assurance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $voiture = Voiture::all()->where('id', '=', $id);
        return view('assurances.add', compact('voiture'));
    }

    public function save(Request $request){
        $request->validate([
            'societeAssurance' => 'required',
            'datedebA' => 'required',
            'datefinA' => 'required',
            'voiture_id'    =>  'required',
            'datefinA'    =>  'required|date|after:datedebA'
        ]);

        $data = $request->all();
        $status = $this->store($data);

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Assurance Enrégistré avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('assurance')->with($parametre);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(array $data)
    {
        $assurances = Assurance::all()
            ->where('status','=',true )
            ->where('voiture_id','=',$data['voiture_id']);
            
        foreach( $assurances as $assurance ){
            $assur = Assurance::find($assurance->id);
            $assur->status = false;
            $assur->update();
        }
        
        return Assurance::create([
            'societeAssurance' => $data['societeAssurance'],
            'datedebA' => $data['datedebA'],
            'datefinA' => $data['datefinA'],
            'voiture_id' => $data['voiture_id']
        ]);

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
        $assurances = Assurance::find($id);
        $voiture = Voiture::all();
        return view('assurances.edit', compact('assurances','voiture'));
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
        $assurance = Assurance::find($id);
        $assurance->societeAssurance = $request->input('societeAssurance');
        $assurance->datedebA = $request->input('datedebA');
        $assurance->datefinA = $request->input('datefinA');
        $assurance->voiture_id = $request->input('voiture_id');
        $status = $assurance->update();

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Assurance modifiée avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('assurance')->with($parametre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assurance = Assurance::find($id);
        if($assurance != null){
            $status = $assurance->delete();
            if( $status ) $parametre = ['status'=>true, 'msg'=>'Assurance supprimée avec succès'];
            else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
            return redirect()->route('assurance')->with($parametre);
        }else{
            return redirect()->route('assurance');
        }
    }
}
