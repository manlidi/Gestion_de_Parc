<?php

namespace App\Models;

use App\Models\Voiture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visite extends Model
{
    use HasFactory;

    protected $fillable = [
        'datevisite',
        'kmvidange',
        'voiture_id',
        'status'
    ];

    public function voiture(){
        return $this->belongsTo(Voiture::class);
    }
}
