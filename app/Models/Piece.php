<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Voiture;

class Piece extends Model
{
    use HasFactory;

    protected $fillable = [
        'nompiece',
        'datefin'
    ];

    
}
