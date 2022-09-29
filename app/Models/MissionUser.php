<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chauffeur;
use App\Models\Voiture;
use App\Models\Mission;

class MissionUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_id',
        'voiture_id',
        'chauffeur_id',
        'kmdeb',
        'kmfin'
    ];

    public function chauffeur(){
        return $this->belongsTo(Chauffeur::class);
    }
    public function voiture(){
        return $this->belongsTo(Voiture::class);
    }
    public function mission(){
        return $this->belongsTo(Mission::class);
    }
}
