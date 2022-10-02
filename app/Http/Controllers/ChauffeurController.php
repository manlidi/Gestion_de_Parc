<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chauffeur;
use App\Models\Structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChauffeurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chauffeurs = User::all()->where('role','Chauffeur');
        return view('chauffeurs.all', ['chauffeurs' => $chauffeurs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authorStructure = User::find(Auth::user()->id)->structure_id;
        $datas = Chauffeur::all('user_id')->toArray();
        $chauffeurUser = array();

        foreach($datas as $data){
            $chauffeurUser = array_merge($chauffeurUser, array($data['user_id']));
        }
        
        $users = DB::table('users')
            ->select('*')
            ->where('structure_id','=',$authorStructure)
            ->where('role','=','Utilisateur')
            ->whereNotIn(
                'id',
                $chauffeurUser
            )
            ->get();

        return view('chauffeurs.add', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chauffeurs = new Chauffeur();
        $chauffeurs->user_id = $request->user_id;
        $chauffeurs->tel = $request->tel;
        $chauffeurs->adresse = $request->adresse;
        $status = $chauffeurs->save();

        $user = User::find($request->user_id);
        $user->role = "Chauffeur";
        $user->update();

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Chauffeur Enrégistré avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('chauffeurs')->with($parametre);
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
