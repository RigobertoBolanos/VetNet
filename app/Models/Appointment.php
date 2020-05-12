<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    private $fillable = [
        'pet',
        'veterinary',
        'services',
        'date'
    ];
    
    public function pet()
    {
        return $this->belongsTo(Pet::class);    
    }

    public function veterinary()
    {
        return $this->belongsTo(veterinary::class);    
    }

    // Muchos a muchos -- Pendiente
    public function service()
    {
        return $this->hasMany(Pet::class);    
    }
}
