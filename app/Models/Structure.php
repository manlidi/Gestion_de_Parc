<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Chauffeur;

class Structure extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomStructure',
        'localisation',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function chauffeurs(){
        return $this->hasMany(Chauffeur::class);
    }

    public function voitures(){
        return $this->hasMany(Voiture::class);
    }

}
