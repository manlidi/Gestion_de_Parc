<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Demande;
use App\Models\Mission;
use App\Models\Voiture;
use App\Models\Chauffeur;
use App\Models\Structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $login = $request->only('email','password');
        if(Auth::attempt($login)){
            return redirect()->intended('dashboard')->with('message','Connecter');
        }
        return redirect('/login')->with('message', 'Une erreur est survenue lors de la connexion!');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $user = new User;
            $user->name = $request->name;
            $user->role = $request->role;
            $user->email = $request->email;
            //$user->password = Hash::make($request->password);
            $user->structure_id = $request->structure_id;
            $status = $user->save();

            if( $status ) $parametre = ['status'=>true, 'msg'=>'Utilisateur Enrégistré avec succès'];
            else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
            return redirect()->route('dashboard')->with($parametre);
    }

    public function validation(){
        return view('layout.validation');
    }



    

    public function savepassword(Request $request){
        $user = User::all()->where('email', '=', $request->email);
        foreach($user as $u){
            dd($u->passoword, $request->password);
            $u->password = Hash::make($request->password);
            $status = $u->update();
        }

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Compte valider avec succès! Veuillez vous connecter'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('login')->with($parametre);
    }

    public function dashboard(){
        if(Auth::check()){
            $structure = Structure::count();
            $voiture = Voiture::all();
            $vo = Voiture::count();
            $mission = Mission::count();
            $chauffeurs = Chauffeur::count();
            $demande = Demande::all()->where('user_id', Auth::user()->id)->where('status', 'Non Approuvée');
            return view('layout.dashboard', compact('structure', 'voiture', 'vo', 'mission', 'chauffeurs', 'demande'));
        }
        return redirect('/login');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $structures = Structure::all();
        return view('layout.register', compact('structures'));
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
    public function destroy()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
