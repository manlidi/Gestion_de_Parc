<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionVoiture extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_id',
        'voiture_id',
        'kmdeb',
        'kmfin',
        'retour'
    ];
}
