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
        'datefinA'
    ];

    public function voitures(){
        return $this->hasMany(Voiture::class);
    }
}
