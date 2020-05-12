<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    private $fillable = [ 'pet', 'medicalrecords'];

    public function medicalrecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
