<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MedicalRecord
 * @package App\Models
 * @version May 13, 2020, 6:02 am UTC
 *
 * @property \App\Models\User $veterinary
 * @property \App\Models\MedicalHistory $medicalHistory
 * @property string $diagnosis
 * @property string $treatments
 * @property string $consultationreason
 * @property integer $veterinary
 * @property integer $medicalhistory
 */
class MedicalRecord extends Model
{
    use SoftDeletes;

    public $table = 'medical_records';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'diagnosis',
        'treatments',
        'consultationreason',
        'veterinary',
        'medicalhistory'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'diagnosis' => 'string',
        'treatments' => 'string',
        'consultationreason' => 'string',
        'date' => 'date',
        'veterinary' => 'integer',
        'medicalhistory' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'diagnosis' => 'required',
        'treatments' => 'required',
        'consultationreason' => 'required',
        'date' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function veterinary()
    {
        return $this->belongsTo(\App\Models\User::class, 'veterinary', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function medicalHistory()
    {
        return $this->belongsTo(\App\Models\MedicalHistory::class);
    }
}
