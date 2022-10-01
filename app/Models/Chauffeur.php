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
        'email',
        'role',
        'password',
        'structure_id'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function structure(){
        return $this->belongsTo(Structure::class);
    }

    public function mission_users(){
        return $this->hasMany(MissionUser::class);
    }
}
