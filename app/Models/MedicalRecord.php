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
        'consultationReason',
        'medicalHistory'
    ];

    public function medicalHistory()
    {
        return $this->belongsTo(MedicalHistory::class);    
    }

    public function veterinary()
    {
        return $this->belongsTo(User::class);    
    }


}
