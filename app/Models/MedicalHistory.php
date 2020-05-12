<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    private $fillable = [
        'pet',
        'medicalRecords'
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);    
    }

    public function medicalrecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
