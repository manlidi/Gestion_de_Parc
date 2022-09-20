<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;


    protected $fillable = [
        'objetmission',
        'datedeb',
        'datefin'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
