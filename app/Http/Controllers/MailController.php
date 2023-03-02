<?php

namespace App\Http\Controllers;

use App\Mail\ValiderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $contenu = [
            'titre' => "OOOOOOOOOOOOOOOO",
            'nom' => "SANT-ANNA"
        ];
        Mail::to('mariesantanna114@gmail.com')->send(new ValiderMail($contenu));
        return "ok";
    }

}
