<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use Hash;
use App\Models\Structure;
use App\Models\User;
use App\Models\Voiture;
use App\Models\Mission;
use App\Models\Chauffeur;

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
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'structure_id' => 'required',
        ]);

        $data = $request->all();
        $check = $this->sign($data);

        return redirect("dashboard");
    }

    public function sign(array $data){
        return User::create([
            'name' => $data['name'],
            'role' => $data['role'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'structure_id' => $data['structure_id']
        ]);
    }

    public function dashboard(){
        if(Auth::check()){
            $structure = Structure::count();
            $voiture = Voiture::all();
            $vo = Voiture::count();
            $mission = Mission::count();
            $chauffeurs = Chauffeur::count();
            return view('layout.dashboard', compact('structure', 'voiture', 'vo', 'mission', 'chauffeurs'));
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
