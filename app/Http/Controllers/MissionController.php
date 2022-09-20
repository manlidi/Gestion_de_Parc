<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mission = Mission::all();
        return view('missions.all', compact('mission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('missions.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'objetmission' => 'required',
            'datedeb' => 'required',
            'datefin' => 'required',
            'datefin'    =>  'required|date|after:datedeb'
        ]);

        $data = $request->all();
        $check = $this->show($data);

        $mission = Mission::all();
        return view('missions.all', compact('mission'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show(array $data)
    {
        return Mission::create([
            'objetmission' => $data['objetmission'],
            'datedeb' => $data['datedeb'],
            'datefin' => $data['datefin']
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mission = Mission::find($id);
        $mission = DB::table('missions')->where('id', $id)->update(['etat' => 'Fait']);

        $mission = Mission::all();
        return view('missions.all', compact('mission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mission = Mission::find($id);
        if($mission != null){
            $mission->delete();
            $mission = Mission::all();
            return view('missions.all', compact('mission'));
        }else{
            echo 'erreur';
        }
    }
}
