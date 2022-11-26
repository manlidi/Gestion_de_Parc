<?php

namespace App\Models;

use App\Models\Piece;
use App\Models\Visite;
use App\Models\Demande;
use App\Models\Assurance;
use App\Models\Structure;
use App\Models\MissionUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voiture extends Model
{
    use HasFactory;

    protected $fillable = [
        'marque',
        'capacite',
        'immatriculation',
        'datdebservice',
        'dureeVie',
        'numchassis',
        'etat',
        'connsommation',
        'kilmax', 
        'coutaquisition',
        'mouvement',
        'date_next_visite',
        'dispo',
        'kmvidange',
        'status_visite',
        'status_vidange',
        'structure_id'
    ];

    public function structure(){
        return $this->belongsTo(Structure::class);
    }

    public function assurances(){
        return $this->hasMany(Assurance::class);
    }

    public function pieces(){
        return $this->hasMany(Piece::class);
    }

    public function mission_users(){
        return $this->hasMany(MissionUser::class);
    }

    public function demandes(){
        return $this->hasMany(Demande::class);
    }

    public function reparers(){
        return $this->hasMany(Reparer::class);
    }

    public function visites(){
        return $this->hasMany(Visite::class);
    }


}
