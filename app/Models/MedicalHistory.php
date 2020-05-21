<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MedicalHistory
 * @package App\Models
 * @version May 13, 2020, 6:03 am UTC
 *
 * @property \App\Models\Pet $pet
 * @property \Illuminate\Database\Eloquent\Collection $medicalRecords
 * @property integer $pet
 */
class MedicalHistory extends Model
{
    use SoftDeletes;

    public $table = 'medical_histories';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'pet'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pet' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function pet()
    {
        return $this->belongsTo(\App\Models\Pet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function medicalRecords()
    {
        return $this->hasMany(\App\Models\MedicalRecord::class);
    }
}
