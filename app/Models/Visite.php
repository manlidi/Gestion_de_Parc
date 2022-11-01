<?php

namespace App\Models;

use App\Models\Voiture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visite extends Model
{
    use HasFactory;

    protected $fillable = [
        'kmvidange',
        'voiture_id'
    ];

    public function voiture(){
        return $this->belongsTo(Voiture::class);
    }
}
