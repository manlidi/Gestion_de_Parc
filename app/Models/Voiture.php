<?php

namespace App\Models;

use App\Models\Assurance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Piece;
use App\Models\MissionUser;
use App\Models\Demande;
use App\Models\Structure;

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
        'kilmax',
        'connsommation',
        'coutaquisition',
        'mouvement',
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

    
}
