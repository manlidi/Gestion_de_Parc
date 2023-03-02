<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chauffeur;
use App\Models\Voiture;
use App\Models\User;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'objetdemande',
        'description',
        'addchauffeur',
        'nbreVoiture',
        'nbPlace',
        'datedeb',
        'datefin',
        'etat',
        'type'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function chauffeur(){
        return $this->belongsTo(Chauffeur::class);
    }

    public function voiture(){
        return $this->belongsTo(Voiture::class);
    }

    public function reparers(){
        return $this->hasMany(Reparer::class);
    }
}
