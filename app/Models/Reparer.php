<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparer extends Model
{
    use HasFactory;

    protected $fillable = [
        'panne',
        'datereparation',
        'pieces',
        'garage_id',
        'voiture_id',
        'user_id',
        'demande_id'
    ];

    public function voiture(){
        return $this->belongsTo(Voiture::class);
    }

    public function garage(){
        return $this->belongsTo(Garage::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function demande(){
        return $this->belongsTo(Demande::class);
    }
}
