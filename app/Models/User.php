<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 
        'password',
        'fullName',
        'address',
        'phoneNumber',
        'professionalCard',
        'contratNumber',
        'academicDegrees',
        'pets',
        'medicalRecords'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
<<<<<<< HEAD
    
    //Veterinary
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    //Pet Owner
    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

=======

    public function pets()
    {
        $this->hasMany(Pet::class);
    }
>>>>>>> f86ceb4e898a9b75e9d60d671e1bc35cbf8b1cd4
}
