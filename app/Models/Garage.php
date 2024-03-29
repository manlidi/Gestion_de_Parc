<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomgarage'
    ];

    public function reparers(){
        return $this->hasMany(Reparer::class);
    }
}
