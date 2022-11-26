<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Structure;
class StructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $structure = Structure::all();
        return view('structures.all', compact('structure'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'nomStructure' => 'required',
            'localisation' => 'required'
        ]);

        $struct = Structure::all();
        foreach($struct as $s){
            if($s->nomStructure == $request->nomStructure){
                $parametre = ['status'=>true, 'msg'=>'Cette structure existe déja !'];
                return redirect()->route('addstructures')->with($parametre);
            }
        }

        $data = $request->all();
        $status = $this->store($data);

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Structure enregistée avec succès'];
        else $parametre = ['status'=>true, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('structures')->with($parametre);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(array $data)
    {
        return Structure::create([
            'nomStructure' => $data['nomStructure'],
            'localisation' => $data['localisation']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('structures.add');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $structure = Structure::find($id);
        return view('structures.edit', compact('structure'));
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
        $structure = Structure::find($id);
        $structure->nomStructure = $request->input('nomStructure');
        $structure->localisation = $request->input('localisation');
        $status = $structure->update();

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Structure modifiée avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('structures')->with($parametre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $structure = Structure::find($id);
        if($structure != null){
            $status = $structure->delete();
            if( $status ) $parametre = ['status'=>true, 'msg'=>'Structure supprimée avec succès'];
            else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
            return redirect()->route('structures')->with($parametre);
        }else{
            $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
            return redirect()->route('structures')->with($parametre);
        }
    }
}
