<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assurance;

class AssuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assurance = Assurance::all();
        return view('assurances.all', compact('assurance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assurances.add');
    }

    public function save(Request $request){
        $request->validate([
            'societeAssurance' => 'required',
            'datedebA' => 'required',
            'datefinA' => 'required',
            'datefinA'    =>  'required|date|after:datedebA'
        ]);

        $data = $request->all();
        $check = $this->store($data);

        $assurance = Assurance::all();
        return view('assurances.all', compact('assurance'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(array $data)
    {
        return Assurance::create([
            'societeAssurance' => $data['societeAssurance'],
            'datedebA' => $data['datedebA'],
            'datefinA' => $data['datefinA']
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

        return view('assurances.edit', compact('assurances'));
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
        $assurance->update();

        $assurance = Assurance::all();
        return view('assurances.all', compact('assurance'));
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
            $assurance->delete();
            $assurance = Assurance::all();
            return view('assurances.all', compact('assurance'));
        }else{
            echo 'erreur';
        }
    }
}
