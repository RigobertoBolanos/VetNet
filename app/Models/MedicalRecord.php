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
<<<<<<< HEAD
        'consultationReason',
=======
        'consultationreason',
>>>>>>> f86ceb4e898a9b75e9d60d671e1bc35cbf8b1cd4
        'medicalHistory'
    ];

    public function medicalHistory()
    {
<<<<<<< HEAD
        return $this->belongsTo(MedicalHistory::class);    
    }

    public function veterinary()
    {
        return $this->belongsTo(User::class);    
    }


=======
        return $this->belongsTo(MedicalRecord::class);
    }
>>>>>>> f86ceb4e898a9b75e9d60d671e1bc35cbf8b1cd4
}
