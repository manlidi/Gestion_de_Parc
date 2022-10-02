<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Structure;
use App\Models\MissionUser;
use App\Models\Demande;

class Chauffeur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tel',
        'adresse',
    ];

    public function structure(){
        return $this->belongsTo(Structure::class);
    }

    public function demandes(){
        return $this->hasMany(Demande::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
