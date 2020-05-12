<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable= [
        'name',
        'age',
        'breed',
        'specie',
        'owner',
        'medicalHistory'
    ];

    public function medicalHistory()
    {
        return $this->hasOne(MedicalHistory::class);    
    } 

    public function owner()
    {
        return $this->belongsTo(User::class);    
    }
}
