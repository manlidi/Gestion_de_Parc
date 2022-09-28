<?php

namespace App\Models;

use App\Models\Voiture;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'societeAssurance',
        'datedebA',
        'datefinA',
        'voiture_id'
    ];

    public function voiture(){
        return $this->belongsTo(Voiture::class);
    }
}
