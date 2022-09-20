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

        $data = $request->all();
        $check = $this->store($data);

        $structure = Structure::all();
        return view('structures.all', compact('structure'));
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
        $structure->update();

        $structure = Structure::all();
        return view('structures.all', compact('structure'));
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
            $structure->delete();
            $structure = Structure::all();
            return view('structures.all', compact('structure'));
        }else{
            echo 'erreur';
        }
    }
}
