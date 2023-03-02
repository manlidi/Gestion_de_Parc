<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Demande;
use App\Models\Mission;
use App\Models\Voiture;
use App\Models\Chauffeur;
use App\Models\Parameter;
use App\Models\Structure;
use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('layout.login');
    }

    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $login = $request->only('email','password');
        if(Auth::attempt($login)){
            $user = Auth::user();
            $user->remember_token = null;

            $user->update();

            return redirect()->intended('dashboard')->with('message','Connecter');
        }else{
            $u = User::all()->where('email','=', $request->email)->first();
            $user = User::find($u->id);
            $user->remember_token += 1;
            if( $user->remember_token >= 3 ){
                $email = $user->email;
                $pass = $this->genererToken();
                $user->password = Hash::make($pass);

                $urlUser = url('/') . "/validationCompte/$email/$pass";
                $this->sendMailUser( $user->email, $urlUser, $user->name );
                $user->update();
                return redirect('/login')->with('message', 'Votre compte est bloqué. Consulter vos mail');
            }
            $user->update();
            return redirect('/login')->with('message', 'Une erreur est survenue lors de la connexion!');
        }

        // $urlUser = url('/') . "/validationCompte/$email/$pass";
        //     $send = $this->sendMailUser( $user->email, $urlUser, $user->name );
    }

    public function store(Request $request)
    {
        $pass = $this->genererToken();
            $user = new User;
            $user->name = $request->name;
            $user->role = $request->role;
            $user->email = $request->email;
            $user->password = Hash::make($pass);
            $user->structure_id = $request->structure_id;

            $email = $user->email;

            $urlUser = url('/') . "/validationCompte/$email/$pass";
            $send = $this->sendMailUser( $user->email, $urlUser, $user->name );
            if( $send ){
                $status = $user->save();
                if( $status ) $parametre = ['status'=>true, 'msg'=>'Utilisateur Enrégistré avec succès', 'class'=>'success'];
                else $parametre = ['status'=>true, 'msg'=>'Erreur lors de l\'enregistrement', 'class'=>'warning'];
            }else{
                $parametre = ['status'=>true, 'msg'=>'Erreur! Nous n\'avons pas pu envoyer l\'email de validation. Réessayer', 'class'=>'warning'];
                return redirect()->route('registerUser')->with($parametre);
            }
            return redirect()->route('dashboard')->with($parametre);
    }

    public function genererToken($taille = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $key = '';
        for ($i = 0; $i < $taille; $i++) {
            $key .= $characters[rand(0, $charactersLength - 1)];
        }
        return $key;
    }

    public function sendMailUser($senderEmail, $url, $name){
        $contenu = [
            'titre' => 'Validation Compte (MP)',
            'nom' => $name,
            'url' => $url
        ];

        return Mail::to($senderEmail)->send(new RegisterMail($contenu));
    }

    public function validation($email, $tok){
        $token =  csrf_token();
        if(Auth::attempt(['email' => $email, 'password' => $tok])){
            $user = Auth::user();
            Session::flush();
            Auth::logout();
            return view('layout.validation', compact('user', 'token'));
        }else{
            return view('layout.errorPage');
        }
    }

    public function updatePass(Request $request, $id){
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $status = $user->update();

        if( $status )
        return redirect()->route('login')->with(['status'=>true, 'msg'=>'Compte valider avec succès! Veuillez vous connecter']);
        else return view('layout.errorPage');
    }

    public function parameter_page(){
        $notifs = Parameter::all();
        return view('layout.parameter', compact('notifs'));
    }

    public function parameter_form(Request $request){
        Parameter::query()->update(['status'=>false]);
        $times = Parameter::all();
        foreach($times as $time){
            if($request->input($time->name) != null){
                $parameter = Parameter::where('name', $time->name)->first();
                $parameter->status = true;
                $parameter->time = $request->input($time->name . '_hour');
                $parameter->update();
            }
        }
        return redirect()->route('parameter-page');
    }

    public function dashboard(){
        if(Auth::check()){
            $structure = Structure::count();
            $voiture = Voiture::all();
            $vo = Voiture::count();
            $mission = Mission::count();
            $chauffeurs = Chauffeur::count();
            $demande = DB::table('demandes')
                ->join('users', 'users.id', '=', 'demandes.user_id')
                ->select('demandes.*')
                ->where('demandes.user_id', '=', Auth::user()->id)
                ->where('status', '=', 'Non Approuvée')
                ->get();
            return view('layout.dashboard', compact('structure', 'voiture', 'vo', 'mission', 'chauffeurs', 'demande'));
        }
        return redirect('/login');
    }

    public function show()
    {
        $structures = Structure::all();
        return view('layout.register', compact('structures'));
    }
    public function destroy()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
