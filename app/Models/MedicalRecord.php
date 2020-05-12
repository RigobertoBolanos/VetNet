<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    private $fillable = 
    [ 
        'veterinary',
        'diagnosis',
        'treatments',
        'date',
        'consultationreason',
        'medicalHistory'
    ];

    public function medicalHistory()
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
