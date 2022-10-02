<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Structure;
use App\Models\Mission;
use App\Models\Demande;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
        'structure_id',
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

    public function missions(){
        return $this->belongsToMany(Mission::class);
    }


    public function demandes(){
        return $this->hasMany(Demande::class);
    }

    public function chauffeur(){
        return $this->hasOne(Chauffeur::class);
    }

    public function reparers(){
        return $this->hasMany(Reparer::class);
    }
}
