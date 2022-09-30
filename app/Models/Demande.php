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
        'objetdemande',
        'datedeb',
        'datefin',
        'voiture_id',
        'chauffeur_id',
        'user_id'
    ];

    public function voiture(){
        return $this->belongsTo(Voiture::class);
    }

    public function chauffeur(){
        return $this->belongsTo(Chauffeur::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
