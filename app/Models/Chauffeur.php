<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Structure;

class Chauffeur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_cva',
        'prenom_cva',
        'tel',
        'adresse',
        'structure_id'
    ];

    public function structure(){
        return $this->belongsTo(Structure::class);
    }
}
