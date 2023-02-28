<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;


    protected $fillable = [
        'demande_id',
        'affecter_id',
        'type',
        'kmdeb',
        'kmfin',
        'status'
    ];

    public function voiture(){
        return $this->belongsTo(Voiture::class, 'affecter_id');
    }

}
