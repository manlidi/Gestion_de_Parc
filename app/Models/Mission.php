<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MissionUser;

class Mission extends Model
{
    use HasFactory;


    protected $fillable = [
        'objetmission',
        'datedeb',
        'datefin'
    ];

    public function mission_users(){
        return $this->hasMany(MissionUser::class);
    }
}
